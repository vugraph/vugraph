<?php namespace Odeva\Masterpoint\Controller;

use DB;
use Input;
use Redirect;
use Request;
use Session;
use Odeva\Masterpoint\Model\Club;
use Odeva\Masterpoint\Model\City;

class Clubs extends Admin {
	
	protected $club;

	public function __construct()
	{
		parent::__construct();
	}
	
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
		$cities =  $city->lists(array('' => trans('tables/common.all')));
		$this->nest('panel.admin.clubs.index', compact('table', 'paginator', 'fields', 'actions', 'cities'));
	}
	
	public function destroy(Club $club)
	{
		$club->delete();
		return Redirect::back()->with('message-success', trans('tables/common.delete_success'));
	}
	
	public function edit(Club $club)
	{
		$this->withInfo(print_r($club, true));
		$this->nest('result');
	}

}