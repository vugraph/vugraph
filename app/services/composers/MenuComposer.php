<?php

class MenuComposer {
	protected $menu = array();
	protected $menuRight = array();
	public function compose($view)
	{
		$this->menu['left'] = array(
			new MenuItem('home', 'icon-home'),
			new MenuItem('menu1'),
			new MenuItem('menu2', null, array(
				new MenuItem('menu2a'),
				new MenuItem('menu2b'),
				new MenuItem('menu2c')
			)),
			new MenuItem('menu3', null, array(
				new MenuItem('menu3a'),
				new MenuItem('menu3b')
			)),
			new MenuItem('menu4')
		);
		if (Sentry::check()) {
			$this->menu['right'] = array(
				new MenuItem('user', 'icon-user'),
				new MenuItem('auth.logout', 'icon-off')
			);
		} else {
			$this->menu['right'] = array(
				new MenuItem('auth.register', 'icon-list-alt'),
				new MenuItem('auth.login', 'icon-user')
			);
		}
		$curRoute = Route::currentRouteName();
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
}