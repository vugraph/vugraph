<?php namespace Odeva\Masterpoint\Page;

use Session;
use URL;

class Basic extends Page {

	protected $title;
	
	protected $heading;
	
	protected $styles = array();
	
	protected $style = '';
	
	protected $scripts = array();
	
	protected $script = '';
	
	protected $navbar = 'layouts._partial.navbar.menu';
	
	protected $breadcrumb = null;
	
	protected $sidebar = null;
	
	public $links = array();
	
	public function __construct($title = null)
	{
		$this->title = is_null($title) ? trans('common.sitename') : $title;
	}
	
	public function setHeading($heading = null)
	{
		if (is_null($heading)) $heading = $this->title;
		$this->heading = $heading;
	}
	
	public function getHeading()
	{
		return $this->heading;
	}
	
	public function setLinks()
	{
		$args = func_get_args();
		foreach($args as $arg) {
			if ($arg == 'back') {
				$link = URL::previous();
				if ($link == URL::current()) $link = route('home');
				$this->links[$link] = trans('common.back');
			} else {
//				if (preg_match('/^panel\./',$arg)) $prefix = 'panel/';
//				else $prefix = '';
				$this->links[route($arg)] = trans('route.'.$arg);
			}
		}
	}
	
	public function getLinks()
	{
		return $this->links;
	}
	
	public function addStyles($styles)
	{
		if (is_string($styles)) $styles = array($styles);
		$this->styles = array_unique(array_merge($this->styles, $styles));
	}
	
	public function getStyles()
	{
		return $this->styles;
	}
	
	public function addStyle($style)
	{
		$this->style .= $style."\n";
	}
	
	public function getStyle()
	{
		return $this->style;
	}
	
	public function addScripts($scripts)
	{
		if (is_string($scripts)) $scripts = array($scripts);
		$this->scripts = array_unique(array_merge($this->scripts, $scripts));
	}
	
	public function getScripts()
	{
		return $this->scripts;
	}
	
	public function addScript($script)
	{
		$this->script .= $script."\n";
	}
	
	public function getScript()
	{
		return $this->script;
	}
	
}