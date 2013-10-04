<?php namespace Odeva\Masterpoint\Model;

use Request;
use Session;
use Validator;
use Illuminate\Database\Eloquent\Model as EloquentModel;

abstract class Model extends EloquentModel {
	
	public $timestamps = false;
	
	protected $perPage = 10;
	
	protected $fields = array();
	
	protected $orderBy = 'id';
	
	protected $orderDir = 'asc';
	
	protected $curPage = 1;
	
	protected $filters = array();
	
	protected $search;
	
	protected $errors;
	
//	public function setFields($fields)
//	{
//		$this->fields = $fields;
//	}
//	
	public function getFields()
	{
		$fields = $this->fields;
		array_walk($fields, function(&$value, $key) {
			$value = trans('tables/'.$this->table.'.fields.'.$key);
		});
		return $fields;
	}
	
	public function getErrors()
	{
		if (!empty($this->errors)) return $this->errors;
		return null;
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
		$paginator = $rset->paginate($this->perPage, $select)->appends($params);
		if ($paginator->getLastPage() < $this->curPage) {
			$total = $paginator->getTotal();
			$results = (array) $rset->forPage($paginator->getCurrentPage(), $this->perPage)->get($select)->all();
			$paginator = $paginator->getEnvironment()->make($results, $total, $this->perPage)->appends($params);
		}
		return $paginator;
	}
	
	protected function processQueryString()
	{
		if (!is_null($orderBy = Request::query('orderby')) && array_key_exists($orderBy, $this->fields)) $this->orderBy = $orderBy;
		if (!is_null($orderDir = Request::query('orderdir')) && in_array($orderDir, array('asc', 'desc'))) $this->orderDir = $orderDir;
		if (!is_null($curPage = intval(Request::query('page', '1'))) && $curPage > 0) $this->curPage = $curPage;
		if (Session::has('prefs.'.$this->table.'.perPage')) $this->perPage = Session::get('prefs.'.$this->table.'.perPage');
		if (!is_null($search = Request::query('search')) && !empty($search)) $this->search = $search;
	}
	
	protected function validate()
	{
		$validator = Validator::make($this->attributes, $this->rules);
		$validator->setAttributeNames(trans('tables/'.$this->getTable().'.fields'));
		if ($validator->passes()) return true;
		$this->errors = $validator->messages();
		return false;
	}

	protected function getErrorInfo($e)
	{
		if ($e->getPrevious()) {
			$pe = $e->getPrevious()->errorInfo;
			if ($pe[0] === '23000' && $pe[1] === 1062) return trans('tables/common.error_duplicate_entry', array('error' => addslashes($pe[2])));
		}
		return $e->getMessage();
	}
	
	public function validateSave(array $options = array())
	{
		if (!$this->validate()) return false;
		try {
			if (!$this->save($options)) return false;
		} catch (\Exception $e) {
			$this->errors = $this->getErrorInfo($e);
			return false;
		}
		return true;
	}

}