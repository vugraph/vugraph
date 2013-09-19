<?php namespace Tbfmp;

use Request;
use Route;
use Session;

class ResourceIndexPage extends UserPage {
	
	protected $routeName;

	protected $fields;
	
	protected $orderFields;
	
	protected $defaultOrderBy = 'id';
	
	protected $defaultOrderDir = 'asc';
	
	protected $orderBy = 'id';
	
	protected $orderDir = 'asc';
	
	protected $perPageValues = array(10, 20, 50, 100);
	
	protected $perPage = 10;
	
	protected $page = 1;
	
	protected $filter;
	
	protected $search;
	
	public function __construct(array $fields, array $orderFields = array())
	{
		parent::__construct();
		$this->fields = array_values($fields);
		$this->orderFields = $orderFields;
		$this->routeName = Route::currentRouteName();
		if (Request::has('page') && ($tmpPage = intval(Request::get('page'))) > 1)
			$this->page = $tmpPage;
		if (Request::has('orderby') && in_array($tmpOrderBy = Request::get('orderby'), $this->orderFields))
			$this->orderBy = $tmpOrderBy;
		if (Request::has('orderdir') && Request::get('orderdir') == 'desc')
			$this->orderDir = 'desc';
		if (Request::has('perpage') && ($tmpPerPage = intval(Request::get('perpage'))) > 0) {
			$this->perPage = $tmpPerPage;
			Session::put('prefs.'.$this->routeName.'.perPage', $tmpPerPage);
		} elseif (Session::has('prefs.'.$this->routeName.'.perPage')) 
			$this->perPage = Session::get('prefs.'.$this->routeName.'.perPage');
		if (Request::has('filter'))
			$this->filter = Request::get('filter');
		if (Request::has('search'))
			$this->search = Request::get('search');
	}
	
	protected function getLink(array $params)
	{
		$query_data = array();
		if ($this->page > 1) $query_data['page'] = $this->page;
		if ($this->orderBy != $this->defaultOrderBy) $query_data['orderby'] = $this->orderBy;
		if ($this->orderDir != $this->defaultOrderDir) $query_data['orderdir'] = $this->orderDir;
		foreach ($params as $key => $value) {
			$query_data[$key] = $value;
			if (is_null($value)) unset($query_data[$key]);
		}
		$q = http_build_query($query_data, '', '&amp;');
		return route($this->routeName).(empty($q) ? '' : '?'.$q);
	}
	
	public function getFields()
	{
		return $this->fields;
	}
	
	public function getPage()
	{
		return $this->page;
	}
	
	public function getOrderBy()
	{
		return $this->orderBy;
	}
	
	public function getOrderDir()
	{
		return $this->orderDir;
	}
	
	public function getOrderByLinks()
	{
		$links = array();
		foreach($this->orderFields as $field) {
			$params = array();
			$params['orderby'] = $field == $this->defaultOrderBy ? null : $field;
			$params['orderdir'] = null;
			if ($this->orderBy == $field && $this->orderDir == $this->defaultOrderDir)
				$params['orderdir'] = $this->orderDir == 'desc' ? 'asc' : 'desc';
			$links[$field] = (object) array(
				'image' => $this->orderBy == $field ? '<i class="icon-chevron-'.($this->orderDir == 'asc' ? 'down' : 'up').'"></i>' : null,
				'link' => $this->getLink($params)
			);
		}
		return $links;
	}

	public function getAppends() {
		$appends = array();
		if ($this->defaultOrderBy != $this->orderBy) $appends['orderby'] = $this->orderBy;
		if ($this->defaultOrderDir != $this->orderDir) $appends['orderdir'] = $this->orderDir;
		return $appends;
	}

	public function getPerPage()
	{
		return $this->perPage;
	}

	public function getPerPageOptions()
	{
		$opts = array();
		foreach ($this->perPageValues as $perPageValue) {
			$opts[] = (object) array(
				'value' => $perPageValue,
				'selected' => $perPageValue == $this->perPage ? true : false,
				'link' => $this->getLink(array('perpage' => $perPageValue))
			);
		}
		return $opts;
	}

}