<?php namespace Odeva\Masterpoint\Controller;

use Session;
use View;

abstract class Controller extends \Illuminate\Routing\Controllers\Controller {

	protected $layout = 'layouts.default';
	
	protected $navbar;
	
	protected $breadcrumb;

	protected $sidebar;

	protected $page;

/* 	protected $viewdata = array(); */
	
	public function __construct()
	{
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->navbar = 'layouts._partial.navbar.menu';
	}

	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
		$this->layout->title = trans('common.sitename');
		$this->layout->styles = array();
		$this->layout->style = '';
		$this->layout->scripts = array();
		$this->layout->script = '';
		if (!empty($this->navbar)) $this->layout->nest('navbar', $this->navbar);
		if (!empty($this->breadcrumb)) $this->layout->nest('breadcrumb',$this->breadcrumb);
		if (!empty($this->sidebar)) $this->layout->nest('sidebar',$this->sidebar);
	}

	protected function nest($view, $data = array())
	{
//		if (!($this->page instanceof Page)) App::abort(500, 'Fatal error. Can\'t show uninitialized page.');
//		require_once(app_path().'/helpers/macros.php');
		$this->layout->nest('content', $view, $data);
	}

	private function instantMessage($type, $msg)
	{
		Session::put('message-'.$type, $msg);
		Session::push('flash.old', 'message-'.$type);
	}
	
	public function withError($msg)
	{
		$this->instantMessage('error', $msg);
	}
	
	public function withWarning($msg)
	{
		$this->instantMessage('warning', $msg);
	}

	public function withInfo($msg)
	{
		$this->instantMessage('info', $msg);
	}
	
	public function withSuccess($msg)
	{
		$this->instantMessage('success', $msg);
	}

}