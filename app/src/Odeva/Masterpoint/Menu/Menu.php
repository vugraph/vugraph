<?php namespace Odeva\Masterpoint\Menu;

use Route;

abstract class Menu {
	
	public $left;
	
	public $right;
	
	public $navbarclass;
	
	public function __construct($navbarclass)
	{
		$this->navbarclass = $navbarclass;
		$this->left = array();
		$this->right = array();
	}
	
	public function setSelectedStatus()
	{
		$curRoute = Route::currentRouteName();
		foreach (array('left', 'right') as $lr) {
			foreach ($this->$lr as $key => $item) {
				if ($item->route == $curRoute || preg_match('/^'.$item->route.'\./', $curRoute)) $item->selected = true;
				foreach($item->items as $key2 => $item2) {
					if ($item2->route == $curRoute || preg_match('/^'.$item2->route.'\./', $curRoute)) {
						$item2->selected = true;
						$item->selected = true;
					}
				}
			}
		}
	}
	
}