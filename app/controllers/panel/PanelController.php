<?php namespace Tbfmp;

use Sentry;

class PanelController extends BaseController {

	protected $user;

	public function __construct()
	{
		parent::__construct();
		$this->beforeFilter('auth');
		$this->user = Sentry::getUser();
	}
	protected function _show($view)
	{
		$this->page->menu = new UserMenu();
		parent::_show($view);
	}
	
	public function getIndex()
	{
		return Redirect::route('panel.account.notifications');
	}

}