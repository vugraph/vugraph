<?php namespace Tbfmp\User\Admin;

use Input;
use Redirect;
use Session;
use Tbfmp\Club;
use Tbfmp\MenuItem;

class ClubController extends AdminController {
	
	protected $defaultOrderBy = 'name';
	protected $orderByFields = array(
		'id',
		'name',
		'city_id',
		'shortname'
	);
	protected $perpageValues = array(
		10,
		20,
		50,
		100
	);

	public function index()
	{
		if (Input::has('perpage')) {
			$perpage = intval(Input::get('perpage'));
			if (in_array($perpage, $this->perpageValues)) Session::put('prefs.admin.clubs.perpage', $perpage);
		}
		if (Session::has('prefs.admin.clubs.perpage')) $perpage = Session::get('prefs.admin.clubs.perpage');
		else $perpage = 20;

		$appends = array();
		if (Input::has('order') && in_array($order = Input::get('order'), $this->orderByFields) && $order != $this->defaultOrderBy) $appends['order'] = $order;
		else $order = $this->defaultOrderBy;
		if (Input::has('dir') && ($dir = Input::get('dir')) == 'desc') $appends['dir'] = $dir;
		else $dir = 'asc';

		$this->title = trans('user/admin/clubs.title');
		$this->scripts[] = 'js/resourceful/index.js';
		$this->viewdata['toolbox'] = array(
			new MenuItem('user.admin.clubs.create', '<i class="icon-plus-sign icon-white"></i> '.trans('tables/common.add_new'))
		);
		$this->viewdata['table'] = 'clubs';
		$this->viewdata['fields'] = array('id', 'name', 'city_id', 'shortname');
		$this->viewdata['orderByAppends'] = array();
		foreach ($this->orderByFields as $orderByField) {
			$this->viewdata['orderByLinks'][$orderByField] = array(
//				'image' => '<i class="icon-chevron-up"></i>';
//				'link' => URL::
			);
		}
		
		$this->viewdata['paginator'] = Club::orderBy($order, $dir)->paginate($perpage, $this->viewdata['fields'])->appends($appends);
		$this->showPage('user.admin.clubs.index');
	}
	
	public function destroy(Club $club)
	{
		$club->delete();
		return Redirect::back()->with('message-success', trans('tables/common.delete_success'));
	}

}