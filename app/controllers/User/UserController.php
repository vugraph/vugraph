<?php namespace Tbfmp\User;

use Tbfmp\BaseController;
use Redirect;
use Sentry;

class UserController extends BaseController {

	protected $user;

	public function __construct()
	{
		parent::__construct();
		$this->beforeFilter('auth');
		$this->user = Sentry::getUser();
//		$this->navbar = 'layouts._partial.navbar.menu';
//		$this->sidebar = 'layouts._partial.sidebar.usermenu';
	}
	
	protected function setupLayout()
	{
		parent::setupLayout();
		$this->viewdata['user'] = $this->user;
	}
	
	public function getIndex()
	{
		return Redirect::route('user.account');
	}
}