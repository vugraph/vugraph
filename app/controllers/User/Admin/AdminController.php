<?php namespace Tbfmp\User\Admin;

use App;
use Tbfmp\User\UserController;

class AdminController extends UserController {
	
	public function __construct()
	{
		parent::__construct();
		$this->beforeFilter('auth.admin');
	}

	protected function setupLayout()
	{
		parent::setupLayout();
	}
	
	public function getIndex()
	{
		$this->showPage('result');
	}

}