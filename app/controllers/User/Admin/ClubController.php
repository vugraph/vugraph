<?php namespace Tbfmp\User\Admin;

use Tbfmp\Club;

class ClubController extends AdminBaseController {

	public function getIndex()
	{
		$fields = array('id', 'name', 'city_id', 'shortname');
		$this->showPage('user.admin.clubs', array(
			'table' => 'clubs',
			'fields' => $fields,
			'paginator' => Club::orderBy('id')->paginate(20, $fields)
		));
	}

}