<?php namespace Odeva\Masterpoint\Controller\Panel\Admin;

use Input;
use Redirect;
use Session;
use URL;
use Odeva\Masterpoint\Model\User;
use Odeva\Masterpoint\Model\Club;
use Odeva\Masterpoint\Model\City;

class Users extends Admin {
	
	public function index()
	{
		$this->title = trans('panel/admin/users.title');
		$this->scripts[] = 'js/resourceful/index.js';
		$user = New User;
		$table = $user->getTable();
		$paginator = $user->autoPaginate();
		$fields = $user->getFields();
		$actions = array(
			'edit' => 'panel.admin.clubs.edit',
			'delete' => 'panel.admin.clubs.destroy'
		);
		$club = New Club;
		$clubs =  array('' => trans('tables/common.all')) + $club->orderBy('name')->lists('name', 'id');
		$city = New City;
		$cities = array('' => trans('tables/common.all')) + $city->orderBy('name')->lists('name', 'id');
		$this->nest('panel.admin.users.index', compact('table', 'paginator', 'fields', 'actions', 'clubs', 'cities'));
	}
	
	public function create()
	{
		if (strpos(URL::previous(), route('panel.admin.users.index').'?') === 0) Session::put('prefs.users.create.previous', URL::previous());
		$this->title = trans('panel/admin/users.create.title');
		$club = New Club;
		$clubs = array('' => '') + $club->orderBy('name')->lists('name', 'id');
		$region = New Region;
		$regions = array('' => '') + $region->orderBy('id')->lists('name', 'id');
		$this->nest('panel.admin.users.edit', compact('clubs', 'regions'));
	}
	
	public function store()
	{
		$user = New User(Input::all());
		if (!$user->validateSave()) return Redirect::back()->withInput()->withErrors($user->getErrors());
		return Redirect::to(Session::get('prefs.users.create.previous', route('panel.admin.users.index')))
			->with('message-success', trans('panel/admin/users.create.success'));
	}
	
	public function destroy(User $user)
	{
		$user->delete();
		return Redirect::back()->with('message-success', trans('tables/common.delete_success'));
	}
	
	public function edit(User $user)
	{
		if (strpos(URL::previous(), route('panel.admin.users.index').'?') === 0) Session::put('prefs.users.edit.previous', URL::previous());
		$this->title = trans('panel/admin/users.edit.title');
		$club = New Club;
		$clubs = array('' => '') + $club->orderBy('name')->lists('name', 'id');
		$region = New Region;
		$regions = array('' => '') + $region->orderBy('name')->lists('name', 'id');
		$this->nest('panel.admin.users.edit', compact('user', 'clubs', 'regions'));
	}
	
	public function update(Club $club)
	{
		$club->fill(Input::all());
		if (!$club->validateSave()) return Redirect::back()->withInput()->withErrors($club->getErrors());
		return Redirect::to(Session::get('prefs.clubs.edit.previous', route('panel.admin.clubs.index')))
			->with('message-success', trans('panel/admin/clubs.edit.success'));
	}
	

}