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
		$orderFields = array('id', 'city_name', 'name');
		$this->page = new ResourceIndexPage(trans('panel/admin/clubs.title'), $fields, $orderFields);
		$this->page->addScriptFile('js/resourceful/index.js');
//		$this->viewdata['page'] = $page;
		array_walk($fields, function(&$value, $key) { if (!is_numeric($key)) $value =  $key.' AS '.$value; });
		$rset = DB::table('clubs')
			->select($fields)
			->join('cities', 'clubs.city_id', '=', 'cities.id')
			->whereNull('deleted_at')
			->orderBy($this->page->getOrderBy(), $this->page->getOrderDir());
		if ($this->page->getOrderBy() != 'id')
			$rset->orderBy('clubs.id', $this->page->getOrderDir());
		$paginator = $rset->paginate($this->page->getPerPage())->appends($this->page->getAppends());
		if ($this->page->getPage() > $paginator->getLastPage()) {
			Session::reflash();
			return Redirect::to($paginator->getUrl($paginator->getLastPage()));
		}
		$this->page->data['paginator'] = $paginator;
		$this->page->data['page'] = $this->page;
		$this->_show('panel.admin.clubs.index');
	}
	
	public function destroy(Club $club)
	{
		$club->delete();
		return Redirect::back()->with('message-success', trans('tables/common.delete_success'));
	}

}