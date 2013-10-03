<?php namespace Odeva\Masterpoint\Controller;

use Session;
use View;
use Illuminate\Routing\Controllers\Controller as LaravelController;

abstract class Controller extends LaravelController {

	protected $layout = 'layouts.default';
	
	protected $navbar = 'layouts._partial.navbar.menu';
	
	protected $breadcrumb;

	protected $sidebar;

	protected $page;
	
	protected $title;

	protected $heading;
	
	protected $styles = array();
	
	protected $style = '';
	
	protected $scripts = array();
	
	protected $script = '';

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
		if (!is_null($this->navbar)) $this->layout->nest('navbar', $this->navbar);
		if (!is_null($this->breadcrumb)) $this->layout->nest('breadcrumb',$this->breadcrumb);
		if (!is_null($this->sidebar)) $this->layout->nest('sidebar',$this->sidebar);
	}

	protected function nest($view, $data = array())
	{
//		if (!($this->page instanceof Page)) App::abort(500, 'Fatal error. Can\'t show uninitialized page.');
//		require_once(app_path().'/helpers/macros.php');
		$this->layout->title = $this->title;
		$this->layout->styles = $this->styles;
		$this->layout->style = $this->style;
		$this->layout->scripts = $this->scripts;
		$this->layout->script = $this->script;
		$this->layout->nest('content', $view, $data);
		if (!is_null($this->heading)) $this->layout->content->heading = $this->heading;
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