<?php namespace Tbfmp;

class HomeController extends SiteController {

	public function getIndex()
	{
		$this->page = new Page();
		$this->_show('home');
	}
	
	public function dump()
	{
		$result = '<h2>GET</h2><pre>';
		$result .= print_r($_GET, true);
		$result .= '</pre><hr><h2>POST</h2>';
		$result .= print_r($_POST, true);
		$result .= '</pre><hr><h2>SESSION</h2>';
		$result .= print_r($_SESSION, true);
		return $result;
	}
	public function missingMethod($parameters)
	{
		$this->page = new Page();
		$this->page->withError('Missing Method at '.__METHOD__.'<br>Parameters:'.print_r($parameters, true));
		$this->_show('result');
	}
	
}