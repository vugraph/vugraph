<?php namespace Odeva\Masterpoint\Controller;

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