<?php namespace Tbfmp;

use Sentry;

class SiteMenu extends BaseMenu {

	public function __construct($navbarclass)
	{
		parent::__construct($navbarclass);
		$this->left = array(
			new MenuItem('home', '<i class="icon-home"></i> '.trans('menu.home')),
			new MenuItem('menu1', trans('menu.menu1')),
			new MenuItem('menu2', trans('menu.menu2'), array(
				new MenuItem('menu2a', trans('menu.menu2a')),
				new MenuItem('menu2b', trans('menu.menu2b')),
				new MenuItem('menu2c', trans('menu.menu2c'))
			)),
			new MenuItem('menu3', trans('menu.menu3'), array(
				new MenuItem('menu3a', trans('menu.menu3a')),
				new MenuItem('menu3b', trans('menu.menu3b'))
			)),
			new MenuItem('menu4', trans('menu.menu4'))
		);
		if (Sentry::check()) {
			$user = Sentry::getUser();
			$this->right = array(
				new MenuItem('user.account', '<i class="icon-user"></i> '.trim($user->first_name.' '.$user->last_name), array(
					new MenuItem('user.account.notifications', '<i class="icon-list-alt"></i> '.trans('menu.user_panel')),
					new MenuItem('auth.logout', '<i class="icon-off"></i> '.trans('menu.logout'))
				))
			);
		} else {
			$this->right = array(
				new MenuItem('auth.register', '<i class="icon-list-alt"></i> '.trans('menu.register')),
				new MenuItem('auth.login', '<i class="icon-user"></i> '.trans('menu.login'))
			);
		}
		$this->setSelectedStatus();
	}

}