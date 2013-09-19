<?php namespace Tbfmp;

use Input;
use Request;
use Session;
use URL;

class PaginationHelper {

	protected $resouceName;

	protected $defaults;

	protected $orderByFields;

	protected $perPage;

	protected $perPageValues;

	protected $orderBy;

	protected $orderByDir;

	public function __construct($resourceName, Array $orderByFields, $defaultOrderBy = null, $defaultOrderByDir = null, Array $perPageValues = null)
	{
		$this->resourceName = $resourceName;
		$this->orderByFields = $orderByFields;
		if (isset($defaultOrderBy)) $this->setDefaultOrderBy($defaultOrderBy);
		else $this->setDefaultOrderBy('id');
		if (isset($defaultOrderByDir)) $this->setDefaultOrderByDir($defaultOrderByDir);
		else $this->setDefaultOrderByDir('asc');
		if (isset($perPageValues)) $this->setPerPageValues($perPageValues);
		else $this->setPerPageValues(array('10', '20', '50', '100'));
		$this->perPage = $this->getPerPage();
		$this->setOrderBy($this->defaultOrderBy);
		$this->setOrderByDir($this->defaultOrderByDir);
	}
	
	protected function setDefaultOrderBy($defaultOrderBy)
	{
		if (in_array($defaultOrderBy, $this->orderByFields)) $this->defaultOrderBy = $defaultOrderBy;
	}
	
	protected function setDefaultOrderByDir($defaultOrderByDir)
	{
		if (in_array($defaultOrderByDir, array('asc', 'desc'))) $this->defaultOrderByDir = $defaultOrderByDir;
	}
	
	public function setPerPage($perPage)
	{
		$perPage = intval($perPage);
		if ($perPage > 0) {
			$this->perPage = $perPage;
			Session::put('prefs.'.$this->resourceName.'.perPage', $perPage);
		}
	}
	
	public function getPerPage()
	{
		if (Session::has('prefs.'.$this->resourceName.'.perPage')) return Session::get('prefs.'.$this->resourceName.'.perPage');
		if (isset($this->perPage)) return $this->perPage;
		return 10;
	}
	
	protected function setPerPageValues(Array $perPageValues)
	{
		$this->perPageValues = $perPageValues;
	}
	
	public function getPerPageOptions()
	{
		$currentPage = intval(Request::query('page'));
		$currentOrderBy = Request::query('order-by');
		$currentOrderByDir = Request::query('order-by-dir');
		$opts = array();
		foreach ($this->perPageValues as $perPageValue) {
			$opt = new \stdClass();
			$opt->value = $perPageValue;
			if ($perPageValue == $this->perPage) $opt->selected = true;
			else $opt->selected = false;
			$params = array();
			if (!empty($currentPage) && $currentPage > 1) $params['page'] = $currentPage;
			if (!empty($currentOrderBy) && $currentOrderBy != $this->defaultOrderBy) $params['order-by'] = $currentOrderBy;
			if (!empty($currentOrderByDir) && $currentOrderByDir != $this->defaultOrderByDir) $params['order-by-dir'] = $currentOrderByDir;
			$params['per-page'] = $perPageValue;
			$opt->link = URL::current().'?'.http_build_query($params, '', '&amp;');
			$opts[] = $opt;
		}
		return $opts;
	}
	
	public function setOrderBy($orderBy)
	{
		if (in_array($orderBy, $this->orderByFields)) $this->orderBy = $orderBy;
		else $this->orderBy = $this->defaultOrderBy;
	}
	
	public function setOrderByDir($orderByDir)
	{
		if (in_array($orderByDir, array('asc', 'desc'))) $this->orderByDir = $orderByDir;
		else $this->orderByDir = $this->defaultOrderByDir;
	}
	public function getOrderBy()
	{
		if (isset($this->orderBy)) return $this->orderBy;
		else return $this->defaultOrderBy;
	}
	
	public function getOrderByDir()
	{
		if (isset($this->orderByDir)) return $this->orderByDir;
		else return $this->defaultOrderByDir;
	}
	
	public function getOrderByLinks()
	{
		$currentPage = intval(Request::query('page'));
//		$currentOrderBy = Request::query('order-by');
//		$currentOrderByDir = Request::query('order-by-dir');
		$orderBy = array();
		foreach($this->orderByFields as $field) {
			$orderBy[$field] = new \stdClass();
			$params = array();
			if (!empty($currentPage) && $currentPage > 1) $params['page'] = $currentPage;
			if ($this->defaultOrderBy != $field) $params['order-by'] = $field;
			if ($this->orderBy == $field) {
				if ($this->orderByDir == 'desc') {
					$orderBy[$field]->image = '<i class="icon-chevron-up"></i> ';
					if ($this->defaultOrderByDir != 'asc') $params['order-by-dir'] = 'asc';
				} else {
					$orderBy[$field]->image = '<i class="icon-chevron-down"></i> ';
					if ($this->defaultOrderByDir != 'desc') $params['order-by-dir'] = 'desc';
				}
			} else {
				// default direction, do nothing
			}
			$orderBy[$field]->link = URL::current().(empty($params) ? '' : '?'.http_build_query($params, '', '&amp;'));
		}
		return $orderBy;
	}
	public function getAppends() {
		$appends = array();
		if ($this->defaultOrderBy != $this->orderBy) $appends['order-by'] = $this->orderBy;
		if ($this->defaultOrderByDir != $this->orderByDir) $appends['order-by-dir'] = $this->orderByDir;
		return $appends;
	}
	
}