<?php namespace Tbfmp\User;

use Tbfmp\BaseController;
use Sentry;

abstract class UserBaseController extends BaseController {

	protected $user;

	public function __construct()
	{
		parent::__construct();
		$this->beforeFilter('auth');
		$this->navbar = 'layouts._partial.navbar.homemenu';
		$this->sidebar = 'layouts._partial.sidebar.usermenu';
		$this->user = Sentry::getUser();
	}
	
	protected function setupLayout()
	{
		parent::setupLayout();
		$this->viewdata['user'] = $this->user;
	}
	
}