<?php namespace Tbfmp;

use Session;
use URL;

class Page {

	public $title;
	
	public $styleFiles = array();
	
	public $style = '';
	
	public $scriptFiles = array();
	
	public $script = '';
	
	public $data = array();
	
	public $navbar = 'layouts._partial.navbar.menu';
	
	public $breadcrumb = null;
	
	public $sidebar = null;
	
	public function __construct($title = null)
	{
		require_once(app_path().'/helpers/macros.php');
		$this->title = is_null($title) ? trans('common.sitename') : $title;
	}
	
	public function setHeading($heading = null)
	{
		if (is_null($heading)) $heading = $this->title;
		$this->data['heading'] = $heading;
	}
	
	public function setLinks()
	{
		$args = func_get_args();
		foreach($args as $arg) {
			if ($arg == 'back') {
				$link = URL::previous();
				if ($link == URL::current()) $link = route('home');
				$this->data['links'][$link] = trans('common.back');
			} else {
//				if (preg_match('/^panel\./',$arg)) $prefix = 'panel/';
//				else $prefix = '';
				$this->data['links'][route($arg)] = trans('route.'.$arg);
			}
		}
	}
	
	public function addStyleFile($styleFiles)
	{
		if (is_string($styleFiles)) $styleFiles = array($styleFiles);
		$this->styleFiles = array_unique(array_merge($this->styleFiles, $styleFiles));
	}
	
	public function addStyle($style)
	{
		$this->style .= $style."\n";
	}
	
	public function addScriptFile($scriptFiles)
	{
		if (is_string($scriptFiles)) $scriptFiles = array($scriptFiles);
		$this->scriptFiles = array_unique(array_merge($this->scriptFiles, $scriptFiles));
	}
	
	public function addScript($script)
	{
		$this->script .= $script."\n";
	}
	
	private function instantMessage($type, $msg)
	{
		Session::put('message-'.$type, $msg);
		Session::push('flash.old', 'message-'.$type);
	}
	
	public function withError($msg)
	{
		$this->instantMessage('error', $msg);
	}
	
	public function withWarning($msg)
	{
		$this->instantMessage('warning', $msg);
	}

	public function withInfo($msg)
	{
		$this->instantMessage('info', $msg);
	}
	
	public function withSuccess($msg)
	{
		$this->instantMessage('success', $msg);
	}

}