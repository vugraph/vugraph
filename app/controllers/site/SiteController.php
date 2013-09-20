<?php namespace Tbfmp;

class SiteController extends BaseController {

	protected function _show($view)
	{
		$this->page->menu = new SiteMenu();
		parent::_show($view);
	}

}