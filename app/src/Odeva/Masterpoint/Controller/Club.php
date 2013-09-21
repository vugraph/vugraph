<?php namespace Odeva\Masterpoint\Controller;

use DB;
use Input;
use Redirect;
use Request;
use Session;
use Odeva\Masterpoint\Page\Index as IndexPage;

class Club extends Admin {
	
	public function index()
	{
		$this->nest('panel.admin.clubs.index');
		$this->layout->title = trans('panel/admin/clubs.title');
//		$this->layout->scripts[] = 'js/resourceful/index.js';
		$fields = array('clubs.id' => 'id', 'cities.name' => 'city_name', 'clubs.name' => 'name', 'clubs.shortname' => 'shortname');
		$orderByFields = array('clubs.id' => 'id', 'cities.name' => 'city_name', 'clubs.name' => 'name');
		$this->layout->content->indexPage = new IndexPage($fields, $orderByFields);
		array_walk($fields, function(&$value, $key) { if (!is_numeric($key)) $value =  $key.' AS '.$value; });
		$rset = DB::table('clubs')
			->select($fields)
			->join('cities', 'clubs.city_id', '=', 'cities.id')
			->whereNull('deleted_at')
			->orderBy($this->layout->content->indexPage->getOrderBy(), $this->layout->content->indexPage->getOrderDir());
		if ($this->layout->content->indexPage->getOrderBy() != 'id')
			$rset->orderBy('clubs.id', $this->layout->content->indexPage->getOrderDir());
		$this->layout->content->paginator = $rset->paginate($this->layout->content->indexPage->getPerPage())->appends($this->layout->content->indexPage->getAppends());
		if ($this->layout->content->indexPage->getPage() > $this->layout->content->paginator->getLastPage()) {
			Session::reflash();
			return Redirect::to($this->layout->content->paginator->getUrl($this->layout->content->paginator->getLastPage()));
		}
	}
	
	public function destroy(Club $club)
	{
		$club->delete();
		return Redirect::back()->with('message-success', trans('tables/common.delete_success'));
	}

}