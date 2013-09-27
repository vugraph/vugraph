<?php namespace Odeva\Masterpoint\Page;

use Request;
use Route;
use Session;

class Index extends Basic {
	
	protected $routeName;

	protected $fields;
	
	protected $orderByFields;
	
	protected $defaultOrderBy = 'id';
	
	protected $defaultOrderDir = 'asc';
	
	protected $orderBy = 'id';
	
	protected $orderDir = 'asc';
	
	protected $perPageValues = array(10, 20, 50, 100);
	
	protected $perPage = 10;
	
	protected $curPage = 1;
	
	protected $filter;
	
	protected $search;
	
	public function __construct($title, array $fields, array $orderByFields = array())
	{
		parent::__construct($title);
		$this->fields = array_values($fields);
		$this->orderByFields = $orderByFields;
		$this->routeName = Route::currentRouteName();
		if (1 < $tmpPage = intval(Request::query('page', 0)))
			$this->curPage = $tmpPage;
		if (in_array($tmpOrderBy = Request::query('orderby'), $this->orderByFields))
			$this->orderBy = $tmpOrderBy;
		if (Request::get('orderdir') == 'desc')
			$this->orderDir = 'desc';
		if (0 < $tmpPerPage = intval(Request::query('perpage', 0))) {
			$this->perPage = $tmpPerPage;
			Session::put('prefs.'.$this->routeName.'.perPage', $tmpPerPage);
		} elseif (Session::has('prefs.'.$this->routeName.'.perPage')) 
			$this->perPage = Session::get('prefs.'.$this->routeName.'.perPage');
		if (Request::has('filter'))
			$this->filter = Request::get('filter');
		if (Request::has('search'))
			$this->search = Request::get('search');
	}
	
	private function getLink(array $params)
	{
		$query_data = array();
		if ($this->curPage > 1) $query_data['page'] = $this->curPage;
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
		return $this->curPage;
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
		foreach($this->orderByFields as $field) {
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