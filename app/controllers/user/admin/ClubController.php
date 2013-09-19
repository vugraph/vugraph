<?php namespace Tbfmp;

use DB;
use Input;
use Redirect;
use Request;
use Session;

class ClubController extends AdminController {
	
	public function index()
	{
		$fields = array('clubs.id' => 'id', 'cities.name' => 'city_name', 'clubs.name' => 'name', 'clubs.shortname' => 'shortname');
		$orderByFields = array('id', 'city_name', 'name');
		$page = new ResourceIndexPage($fields, $orderByFields);
		$this->title = trans('user/admin/clubs.title');
		$this->scripts[] = 'js/resourceful/index.js';
		$this->viewdata['page'] = $page;
		array_walk($fields, function(&$value, $key) { if (!is_numeric($key)) $value =  $key.' AS '.$value; });
		$rset = DB::table('clubs')
			->select($fields)
			->join('cities', 'clubs.city_id', '=', 'cities.id')
			->whereNull('deleted_at')
			->orderBy($page->getOrderBy(), $page->getOrderDir());
		if ($page->getOrderBy() != 'id')
			$rset->orderBy('clubs.id', $page->getOrderDir());
		$paginator = $rset->paginate($page->getPerPage())->appends($page->getAppends());
		if ($page->getPage() > $paginator->getLastPage()) {
			Session::reflash();
			return Redirect::to($paginator->getUrl($paginator->getLastPage()));
		}
		$this->viewdata['paginator'] = $paginator;
		$this->showPage('user.admin.clubs.index');
	}
	
	public function destroy(Club $club)
	{
		$club->delete();
		return Redirect::back()->with('message-success', trans('tables/common.delete_success'));
	}

}