<?php

class HomeController extends BaseController {

	public function getIndex()
	{
		$this->showPage('home', array('test' => 'testt'));
	}
	
	public function getTest()
	{
		$this->title = 'Test';
		return 'test method is functioning';
	}
	
	public function getGiris()
	{
		$this->title = 'Giriş';
		return 'Giriş';
	}
	
	public function missingMethod($parameters)
	{
		$this->showPage('home');
	}

}