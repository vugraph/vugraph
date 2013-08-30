<?php

class BaseController extends Controller {

	protected $layout = 'layouts.default';
	
	protected $navbar = 'layouts._partial.navbar.topmenu';
	
	protected $breadcrumb = 'layouts._partial.navbar.breadcrumb';

	/**
	 * Simple sidebar example
	 * protected $sidebar = 'layouts._partial.sidebar';
	 * 
	 * For sidebars which behaves different according to logged in or not, use:
	 * protected $sidebar = array( 'guest' => '...', 'auth' => '...' );
	 */
	protected $sidebar = array(
		'guest' => 'layouts._partial.sidebar.small-login-form',
		'auth' => 'layouts._partial.sidebar.usermenu'
	);
	
	protected $title;
	
	protected $heading;
	
	protected $topmenu;
	
	protected $usermenu;
	
	protected $viewdata = array();
	
	public function __construct()
	{
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->title = Config::get('app.sitename');
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
		if (is_null($this->navbar)) return;
		if (is_null($this->topmenu)) $this->populateTopMenu();
		$this->layout->nest('navbar', $this->navbar, array('topmenu' => $this->topmenu));
		if (!is_null($this->breadcrumb)) $this->layout->nest('breadcrumb', $this->breadcrumb);
	}

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
	
	protected function showPage($view, $data = array())
	{
		if (!is_null($this->title)) $this->layout->title = $this->title;
		if (!is_null($this->heading)) $this->layout->heading = $this->heading;
		if (!empty($this->navbar)) $this->setupNavbar();
		if (!empty($this->sidebar)) $this->setupSidebar();
		$this->layout->content = View::make($view, array_merge($this->viewdata, $data));
	}

}