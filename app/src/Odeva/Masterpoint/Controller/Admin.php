<?php namespace Odeva\Masterpoint\Controller;

use App;

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