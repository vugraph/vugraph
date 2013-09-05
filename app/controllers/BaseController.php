<?php

class BaseController extends Controller {

	protected $layout = 'layouts.default';
	
	protected $navbar;
	
	protected $breadcrumb;
	
	protected $title;
	
	protected $heading;
	
	protected $viewdata = array();
	
	public function __construct()
	{
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->title = trans('common.sitename');
	}

	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	protected function setupNavbar()
	{
//		if (is_null($this->navbar)) return;
//		if (is_null($this->topmenu)) $this->populateTopMenu();
		if (isset($this->navbar)) $this->layout->nest('navbar', $this->navbar); //, array('topmenu' => $this->topmenu));
		if (isset($this->breadcrumb)) $this->layout->nest('breadcrumb', $this->breadcrumb);
	}

/*
	protected function setupSidebar()
	{
		if (is_null($this->sidebar)) return;
		if (is_array($this->sidebar)) {
			if (Sentry::check() && isset($this->sidebar['auth'])) {
				if (is_null($this->usermenu)) $this->populateUserMenu();
				$sidebar = $this->sidebar['auth'];
			} elseif (isset($this->sidebar['guest'])) {
				$sidebar = $this->sidebar['guest'];
			} else return;
		} elseif (is_string($this->sidebar)) {
			$sidebar = $this->sidebar;
		} else return;
		if (is_null($this->usermenu)) $this->layout->nest('sidebar', $sidebar);
		else $this->layout->nest('sidebar', $sidebar, compact($this->usermenu));
	}

	protected function populateTopMenu() {
		$this->topmenu = Config::get('topmenu');
	}
	
	protected function populateUserMenu() {
		$this->usermenu = Config::get('usermenu');
	}
*/
	
	protected function showPage($view, $data = array())
	{
		if (isset($this->title)) $this->layout->title = $this->title;
		if (isset($this->heading)) $this->layout->heading = $this->heading;
		if (isset($this->navbar)) $this->setupNavbar();
//		if (!empty($this->sidebar)) $this->setupSidebar();
		$this->layout->content = View::make($view, array_merge($this->viewdata, $data));
	}
	
	private function instantMessage($type, $msg)
	{
		Session::put('message-'.$type, $msg);
		Session::push('flash.old', 'message-'.$type);
	}
	
	protected function withError($msg)
	{
		$this->instantMessage('error', $msg);
	}
	
	protected function withWarning($msg)
	{
		$this->instantMessage('warning', $msg);
	}

	protected function withInfo($msg)
	{
		$this->instantMessage('info', $msg);
	}
	
	protected function withSuccess($msg)
	{
		$this->instantMessage('success', $msg);
	}
}