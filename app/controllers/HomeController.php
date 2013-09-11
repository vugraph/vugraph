<?php namespace Tbfmp;

class HomeController extends BaseController {

	public function __construct() {
		parent::__construct();
//		$this->navbar = 'layouts._partial.navbar.homemenu';
//		$this->breadcrumb = 'layouts._partial.navbar.breadcrumb';
	}
	public function getIndex()
	{
		$this->showPage('home');
	}
	
	public function missingMethod($parameters)
	{
		$this->showPage('result', array('message' => 'Missing Method at '.__METHOD__.'<br>Parameters:'.print_r($parameters, true)));
	}
	
}