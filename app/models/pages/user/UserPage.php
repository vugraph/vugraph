<?php namespace Tbfmp;

class UserPage extends BasePage {
	
	public function __construct()
	{
		parent::__construct();
		$this->menu = new UserMenu('navbar navbar-fixed-top navbar-inverse');
	}
	
}