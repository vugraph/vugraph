<?php namespace Odeva\Masterpoint\Controller;

use Sentry;
use Odeva\Masterpoint\Menu\User as UserMenu;

class Panel extends Controller {

	public function __construct()
	{
		parent::__construct();
		$this->beforeFilter('auth');
		$this->user = Sentry::getUser();
	}

	protected function setupLayout()
	{
		parent::setupLayout();
		$this->layout->navbar->menu = new UserMenu;
	}
	
	public function getIndex()
	{
		return Redirect::route('panel.account.notifications');
	}

}