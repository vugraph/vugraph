<?php namespace Odeva\Masterpoint\Service;

use Request;
use Route;
use Session;
use Illuminate\Database\Query\Builder as QueryBuilder;

class DataTable {
	
	protected $fields;
	
	protected $paginator;
	
	public function __construct(QueryBuilder $rset, $table, $fields, array $orderByFields = array())
	{
		$this->fields = array_keys($fields);
		$route = Route::currentRouteName();
		$orderBy = 'id';
		$orderDir = 'asc';
		$curPage = 1;
		$perPage = 10;
		$select = array();
		foreach($fields as $key => $value) $select[] = empty($value) || $key == $value ? $value : $value.' AS '.$key;
//		array_walk($fields, function(&$value, $key) { if (!is_numeric($key)) $value =  $value.' AS '.$key; });
		$rset->select($select);
		if (in_array($tmpOrderBy = Request::query('orderby'), $orderByFields)) $orderBy = $tmpOrderBy;
		if (Request::query('orderdir') == 'desc') $orderDir = 'desc';
		$rset->orderBy($fields[$orderBy], $orderDir);
		if ($orderBy != 'id') $rset->orderBy($fields['id'], $orderDir);
		if (1 < $tmpPage = intval(Request::query('page', 0))) $curPage = $tmpPage;
		if (0 < $tmpPerPage = intval(Request::query('perpage', 0))) {
			$perPage = $tmpPerPage;
			Session::put('prefs.'.$route.'.perPage', $tmpPerPage);
		} elseif (Session::has('prefs.'.$route.'.perPage')) $perPage = Session::get('prefs.'.$route.'.perPage');
		//$filter = Request::query('filter');
		//$search = Request::query('search');
		$this->paginator = $rset->paginate($perPage);
		if ($curPage > $lastPage = $this->paginator->getLastPage()) {
			$this->paginator = $rset->forPage($lastPage, $perPage)->paginate($perPage);
		}
		$params = Request::query();
		unset($params['page']);
		if (count($params)) $this->paginator->appends($params);

	}
	
	public function getFields()
	{
		return $this->fields;
	}
	
	public function getPaginator()
	{
		return $this->paginator;
	}
	
}