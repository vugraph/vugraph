<?php

class UserMenuComposer {
	protected $menu = array();
	public function compose($view)
	{
		if (!Sentry::check()) return;
		try {
			$this->menu[] = array(
				new MenuItem('user.home')
			);
			$this->menu['user.header'] = array(
				new MenuItem('user.account-information', 'icon-chevron-right'),
				new MenuItem('user.change-password', 'icon-chevron-right')
			);
			$user = Sentry::getUser();
			if ($user->hasAccess('club')) {
				$this->menu['user.club.header'] = array(
					new MenuItem('user.club.details'),
					new MenuItem('user.club.add-tournament')
				);
			}
/*			$this->menu[] = array(
				new MenuItem('user.logout', 'icon-off')
			); */
		} catch (Exception $e) {
			App::abort(500, $e->getMessage());
		}
		
		$curRoute = Route::currentRouteName();
		if ($curRoute == 'user') $curRoute = 'user.home';
		foreach ($this->menu as $menukey => $menu) {
			foreach ($menu as $key => $item) {
				if ($item->route == $curRoute || preg_match('/^'.$item->route.'\./', $curRoute)) $this->menu[$menukey][$key]->selected = true;
				foreach($item->items as $key2 => $item2) {
					if ($item2->route == $curRoute || preg_match('/^'.$item2->route.'\./', $curRoute)) {
						$this->menu[$menukey][$key]->items[$key2]->selected = true;
						$this->menu[$menukey][$key]->selected = true;
					}
				}
			}
		}
		$view->with('usermenu', $this->menu);
		$view->with('user', Sentry::getUser());
	}
}