<?php namespace Odeva\Masterpoint\Controller;

use Input;
use Redirect;
use Session;
use URL;
use Odeva\Masterpoint\Model\Club;
use Odeva\Masterpoint\Model\City;

class Clubs extends Admin {
	
	public function index()
	{
		$this->title = trans('panel/admin/clubs.title');
		$this->scripts[] = 'js/resourceful/index.js';
		$club = New Club;
		$table = $club->getTable();
		$paginator = $club->autoPaginate();
		$fields = $club->getFields();
		$actions = array(
			'edit' => 'panel.admin.clubs.edit',
			'delete' => 'panel.admin.clubs.destroy'
		);
		$city = New City;
		$cities =  array('' => trans('tables/common.all')) + $city->orderBy('name')->lists('name', 'id');
		$this->nest('panel.admin.clubs.index', compact('table', 'paginator', 'fields', 'actions', 'cities'));
	}
	
	public function create()
	{
		if (strpos(URL::previous(), route('panel.admin.clubs.index').'?') === 0) Session::put('prefs.clubs.create.previous', URL::previous());
		$this->title = trans('panel/admin/clubs.create.title');
		$city = New City;
		$cities = $city->orderBy('name')->lists('name', 'id');
		$this->nest('panel.admin.clubs.edit', compact('cities'));
	}
	
	public function store()
	{
		$club = New Club;
		$club->fill(Input::all());
		if (!$club->validateSave()) return Redirect::back()->withInput()->withErrors($club->getErrors());
		return Redirect::to(Session::get('prefs.clubs.create.previous', route('panel.admin.clubs.index')))
			->with('message-success', trans('panel/admin/clubs.create.success'));
	}
	
	public function destroy(Club $club)
	{
		$club->delete();
		return Redirect::back()->with('message-success', trans('tables/common.delete_success'));
	}
	
	public function edit(Club $club)
	{
		if (strpos(URL::previous(), route('panel.admin.clubs.index').'?') === 0) Session::put('prefs.clubs.edit.previous', URL::previous());
		$this->title = trans('panel/admin/clubs.edit.title');
		$city = New City;
		$cities = $city->orderBy('name')->lists('name', 'id');
		$this->nest('panel.admin.clubs.edit', compact('club', 'cities'));
	}
	
	public function update(Club $club)
	{
		$club->fill(Input::all());
		if (!$club->validateSave()) return Redirect::back()->withInput()->withErrors($club->getErrors());
		return Redirect::to(Session::get('prefs.clubs.edit.previous', route('panel.admin.clubs.index')))
			->with('message-success', trans('panel/admin/clubs.edit.success'));
	}
	

}