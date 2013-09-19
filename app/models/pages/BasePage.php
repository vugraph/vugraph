<?php namespace Tbfmp;

abstract class BasePage {

	public $title;
	
	public $styleFiles = array();
	
	public $style = '';
	
	public $scriptFiles = array();
	
	public $script = '';
	
	public $data = array();
	
	public $navbar = 'layouts._partial.navbar.menu';
	
	public $breadcrumb = null;
	
	public $sidebar = null;
	
	public $content = null;
	
	public function __construct($title = null)
	{
		$this->title = is_null($title) ? trans('common.sitename') : $title;
	}
	
	public function setTitle($title)
	{
		$this->title = $title;
	}
	
	public function setHeading($heading)
	{
		$this->data['heading'] = $heading;
	}
	
	public function setTitleAndHeading($title)
	{
		$this->title = $this->data['heading'] = $title;
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