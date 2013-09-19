<?php namespace Tbfmp;

use Controller;
use Session;
use View;

class BaseController extends Controller {

	protected $layout = 'layouts.default';
	
	protected $page;

	protected $navbar;
	
	protected $breadcrumb;

	protected $sidebar;

	protected $title;
	
	protected $styles;
	
	protected $style;
	
	protected $scripts;
	
	protected $viewdata = array();
	
	public function __construct()
	{
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->title = trans('common.sitename');
		$this->navbar = 'layouts._partial.navbar.menu';
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
		if (isset($this->navbar)) $this->layout->nest('navbar', $this->navbar);
		if (isset($this->breadcrumb)) $this->layout->nest('breadcrumb', $this->breadcrumb);
	}
	
	protected function setupSidebar()
	{
		if (isset($this->sidebar)) $this->layout->nest('sidebar', $this->sidebar);
	}

	protected function showPage($view, $data = array())
	{
		$this->layout->title = $this->viewdata['title'] = $this->title;
		if (!empty($this->styles)) $this->layout->styles = $this->styles;
		if (!empty($this->style)) $this->layout->style = $this->style;
		if (!empty($this->scripts)) $this->layout->scripts = $this->scripts;
		if (!empty($this->script)) $this->layout->script = $this->script;
		$this->setupNavbar();
		$this->setupSidebar();
		$this->layout->content = View::make($view, array_merge($this->viewdata, $data));
	}
	
	protected function _show($view)
	{
		$this->layout->page = $this->page;
		if (!empty($this->page->navbar)) $this->layout->nest('navbar', $this->page->navbar, array('menu' => $this->page->menu));
		if (!empty($this->page->breadcrumb)) $this->layout->nest('breadcrumb', $this->page->breadcrumb);
		if (!empty($this->page->sidebar)) $this->layout->nest('sidebar', $this->page->sidebar);
		$this->layout->nest('content', $view, array('data' => $this->page->data));
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