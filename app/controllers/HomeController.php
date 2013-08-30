<?php

class HomeController extends BaseController {

	public function getIndex()
	{
		$this->showPage('site.home');
	}
	
	public function missingMethod($parameters)
	{
		$this->showPage('blank', array('message' => 'Missing Method at '.__METHOD__.'<br>Parameters:'.print_r($parameters, true)));
	}
	
}