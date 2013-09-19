<?php namespace Tbfmp;

class SitePage extends BasePage {
	
	public function __construct($title)
	{
		parent::__construct($title);
		$this->menu = new SiteMenu('navbar navbar-fixed-top');
	}

}