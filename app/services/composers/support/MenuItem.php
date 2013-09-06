<?php

class MenuItem {
	public $route;
	public $icon;
	public $items;
	public $selected;
	public function __construct($route, $icon = null, $items = array(), $selected = false)
	{
		$this->route = $route;
		$this->icon = $icon;
		$this->items = $items;
		$this->selected = $selected;
	}
}