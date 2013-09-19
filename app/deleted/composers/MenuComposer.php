<?php namespace Tbfmp;

use App;
use Exception;
use Route;
use Sentry;

class MenuComposer {

	protected $menu = array();

	public function compose($view)
	{
		$curRoute = Route::currentRouteName();
		if (preg_match('/^user\./', $curRoute)) {
			$this->initUserMenu();
			$view->with('navbarclass', 'navbar navbar-fixed-top navbar-inverse');
		} else {
			$this->initMainMenu();
			$view->with('navbarclass', 'navbar navbar-fixed-top');
		}
		foreach ($this->menu as $lr => $menu) {
			foreach ($menu as $key => $item) {
				if ($item->route == $curRoute || preg_match('/^'.$item->route.'\./', $curRoute)) $this->menu[$lr][$key]->selected = true;
				foreach($item->items as $key2 => $item2) {
					if ($item2->route == $curRoute || preg_match('/^'.$item2->route.'\./', $curRoute)) {
						$this->menu[$lr][$key]->items[$key2]->selected = true;
						$this->menu[$lr][$key]->selected = true;
					}
				}
			}
		}
		$view->with('menu', $this->menu);
	}

	private function initMainMenu() {
		$this->menu['left'] = array(
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
			$this->menu['right'] = array(
				new MenuItem('user.account', '<i class="icon-user"></i> '.trim($user->first_name.' '.$user->last_name), array(
					new MenuItem('user.account.notifications', '<i class="icon-list-alt"></i> '.trans('menu.user_panel')),
					new MenuItem('auth.logout', '<i class="icon-off"></i> '.trans('menu.logout'))
				))
			);
		} else {
			$this->menu['right'] = array(
				new MenuItem('auth.register', '<i class="icon-list-alt"></i> '.trans('menu.register')),
				new MenuItem('auth.login', '<i class="icon-user"></i> '.trans('menu.login'))
			);
		}
	}

	private function initUserMenu()
	{
		try {
			$this->menu['left'][] = new MenuItem('home', '<i class="icon-home icon-white"></i> '.trans('user/menu.home'));
			$user = Sentry::getUser();
			if ($user->hasAccess('club')) {
				$this->menu['left'][] = new MenuItem('user.club', trans('user/menu.club'), array(
					new MenuItem('user.club.tournaments', '<i class="icon-chevron-right"></i> '.trans('user/menu.club.tournaments'))
				));
			}
			if ($user->hasAccess('superuser')) {
				$this->menu['left'][] = new MenuItem('user.admin', trans('user/menu.admin'), array(
					new MenuItem('user.admin.clubs.index', '<i class="icon-chevron-right"></i> '.trans('user/menu.admin.manage_clubs'))
				));
			}
			$this->menu['right'] = array(
				new MenuItem('user.account', '<i class="icon-user icon-white"></i> '.trim($user->first_name.' '.$user->last_name), array(
					new MenuItem('user.account.notifications', '<i class="icon-list-alt"></i> '.trans('user/menu.notifications')),
					new MenuItem('user.account.details', '<i class="icon-edit"></i> '.trans('user/menu.account_details')),
					new MenuItem('user.account.password', '<i class="icon-lock"></i> '.trans('user/menu.change_password')),
					new MenuItem('auth.logout', '<i class="icon-off"></i> '.trans('user/menu.logout'))
				)
			));
		} catch (Exception $e) {
			App::abort(500, $e->getMessage());
		}
	}

}