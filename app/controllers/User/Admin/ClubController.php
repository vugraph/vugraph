<?php namespace Tbfmp\User\Admin;

use DB;
use Input;
use Redirect;
use Request;
use Session;
use Tbfmp\Club;
use Tbfmp\MenuItem;
use Tbfmp\User\PaginationHelper;

class ClubController extends AdminController {
	
	public function index()
	{
		$fields = array('id' => 'clubs.id', 'city_name' => 'cities.name', 'name' => 'clubs.name', 'shortname' => 'clubs.shortname');
		$orderByFields = array('id', 'city_name', 'name');
		$paginationHelper = new PaginationHelper('clubs', $orderByFields, 'id');
		if (Input::has('per-page')) $paginationHelper->setPerPage(Input::get('per-page'));
		if (Input::has('order-by')) $paginationHelper->setOrderBy(Input::get('order-by'));
		if (Input::has('order-by-dir')) $paginationHelper->setOrderByDir(Input::get('order-by-dir'));
		$this->title = trans('user/admin/clubs.title');
		$this->scripts[] = 'js/resourceful/index.js';
		$this->viewdata['fields'] = array_keys($fields);
		$this->viewdata['perPageOptions'] = $paginationHelper->getPerPageOptions();
		$this->viewdata['orderBy'] = $paginationHelper->getOrderByLinks();
		array_walk($fields, function(&$value, $key) { if (!is_numeric($key)) $value =  $value.' AS '.$key; });
		$rset = DB::table('clubs')
			->select($fields)
			->join('cities', 'clubs.city_id', '=', 'cities.id')
			->whereNull('deleted_at')
			->orderBy($paginationHelper->getOrderBy(), $paginationHelper->getOrderByDir());
		if ($paginationHelper->getOrderBy() != 'id')
			$rset->orderBy('clubs.id', $paginationHelper->getOrderByDir());
		$paginator = $rset->paginate($paginationHelper->getPerPage())->appends($paginationHelper->getAppends());
		if (Request::query('page') > $paginator->getLastPage()) return Redirect::to($paginator->getUrl($paginator->getLastPage()));
		$this->viewdata['paginator'] = $paginator;
		$this->showPage('user.admin.clubs.index');
	}
	
	public function destroy(Club $club)
	{
		$club->delete();
		return Redirect::back()->with('message-success', trans('tables/common.delete_success'));
	}

}