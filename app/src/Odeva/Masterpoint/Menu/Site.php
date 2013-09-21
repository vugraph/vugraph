<?php namespace Odeva\Masterpoint\Menu;

use Sentry;

class Site extends Menu {

	public function __construct()
	{
		parent::__construct('navbar navbar-fixed-top');
		$this->left = array(
			new Item('home', '<i class="icon-home"></i> '.trans('menu.home')),
			new Item('menu1', trans('menu.menu1')),
			new Item('menu2', trans('menu.menu2'), array(
				new Item('menu2a', trans('menu.menu2a')),
				new Item('menu2b', trans('menu.menu2b')),
				new Item('menu2c', trans('menu.menu2c'))
			)),
			new Item('menu3', trans('menu.menu3'), array(
				new Item('menu3a', trans('menu.menu3a')),
				new Item('menu3b', trans('menu.menu3b'))
			)),
			new Item('menu4', trans('menu.menu4'))
		);
		if (Sentry::check()) {
			$user = Sentry::getUser();
			$this->right = array(
				new Item('panel.account', '<i class="icon-user"></i> '.substr(trim($user->first_name.' '.$user->last_name), 0, 20), array(
					new Item('panel.account.notifications', '<i class="icon-list-alt"></i> '.trans('menu.user_panel')),
					new Item('auth.logout', '<i class="icon-off"></i> '.trans('menu.logout'))
				))
			);
		} else {
			$this->right = array(
				new Item('auth.register', '<i class="icon-list-alt"></i> '.trans('menu.register')),
				new Item('auth.login', '<i class="icon-user"></i> '.trans('menu.login'))
			);
		}
		$this->setSelectedStatus();
	}

}