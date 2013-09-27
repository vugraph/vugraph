<?php namespace Odeva\Masterpoint\Model;

use Request;
use Session;

abstract class Model extends \Illuminate\Database\Eloquent\Model {
	
	protected $fields = array();
	
	protected $orderBy = 'id';
	
	protected $orderDir = 'asc';
	
	protected $curPage = 1;
	
	protected $filters = array();
	
	protected $search;
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function setFields($fields)
	{
		$this->fields = $fields;
	}
	
	public function getFields()
	{
		$fields = $this->fields;
		array_walk($fields, function(&$value, $key) {
			$value = trans('tables/'.$this->table.'.fields.'.$key);
		});
		return $fields;
	}
	
	protected function getPagination($rset)
	{
		if (is_null($rset)) $rset = $this->newQuery();
		$rset->orderBy($this->orderBy, $this->orderDir);
		if ($this->orderBy != 'id') $rset->orderBy('id', $this->orderDir);
		foreach($this->filters as $key => $value) $rset->where($key, '=', $value);
		if (!empty($this->search)) $rset->where('clubs.name', 'like', '%'.$this->search.'%');
		$select = array();
		foreach($this->fields as $key => $value) $select[] = empty($value) || $key == $value ? $value : $value.' AS '.$key;
		$params = Request::query();
		unset($params['page']);
		unset($params['perpage']);
		return $rset->paginate($this->perPage, $select)->appends($params);
	}
	
	protected function processQueryString()
	{
		if (!is_null($orderBy = Request::query('orderby')) && array_key_exists($orderBy, $this->fields)) $this->orderBy = $orderBy;
		if (!is_null($orderDir = Request::query('orderdir')) && in_array($orderDir, array('asc', 'desc'))) $this->orderDir = $orderDir;
		if (!is_null($curPage = intval(Request::query('page', '1'))) && $curPage > 0) $this->curPage = $curPage;
		if (0 < $perPage = intval(Request::query('perpage', '0'))) {
			$this->perPage = $perPage;
			Session::put('prefs.'.$this->table.'.perPage', $perPage);
		} elseif (Session::has('prefs.'.$this->table.'.perPage')) $this->perPage = Session::get('prefs.'.$this->table.'.perPage');
		if (!is_null($search = Request::query('search')) && !empty($search)) $this->search = $search;
	}

	public function lists($prepend)
	{
		if (is_null($prepend)) return $this->newQuery()->orderBy('name')->lists('name', 'id');
		return array(0 => $prepend) + $this->newQuery()->orderBy('name')->lists('name', 'id');
	}
	
}