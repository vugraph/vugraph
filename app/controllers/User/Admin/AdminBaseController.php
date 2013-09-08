<?php namespace Tbfmp\User\Admin;

use App;
use Tbfmp\User\UserBaseController;

class AdminBaseController extends UserBaseController {
	
	public function __construct()
	{
		parent::__construct();
		$this->beforeFilter('auth.admin');
	}

}