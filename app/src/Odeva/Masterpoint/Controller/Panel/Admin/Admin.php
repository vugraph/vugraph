<?php namespace Odeva\Masterpoint\Controller\Panel\Admin;

use Odeva\Masterpoint\Controller\Panel\Panel;

class Admin extends Panel {
	
	public function __construct()
	{
		parent::__construct();
		$this->beforeFilter('auth.admin');
	}

	public function getIndex()
	{
		$this->nest('result');
	}

}