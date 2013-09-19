<?php namespace Tbfmp;

class HomeController extends BaseController {

	public function __construct() {
		parent::__construct();
		$this->page = new SitePage();
//		$this->navbar = 'layouts._partial.navbar.homemenu';
//		$this->breadcrumb = 'layouts._partial.navbar.breadcrumb';
	}
	public function getIndex()
	{
		$this->_show('home');
	}
	
	public function missingMethod($parameters)
	{
		$this->errorInstant('Missing Method at '.__METHOD__.'<br>Parameters:'.print_r($parameters, true));
		$this->_show('result');
	}
	
}