<?php namespace Tbfmp;

use App;

class AdminController extends PanelController {
	
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
		$this->_show('result');
	}

}