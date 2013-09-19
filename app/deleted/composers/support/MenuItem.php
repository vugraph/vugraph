<?php namespace Tbfmp;

class MenuItemOld {
	public $route;
	public $content;
	public $items;
	public $selected;
	public function __construct($route, $content, $items = array(), $selected = false)
	{
		$this->route = $route;
		$this->content = $content;
		$this->items = $items;
		$this->selected = $selected;
	}
}