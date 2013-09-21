<?php namespace Odeva\Masterpoint\Controller;

use Odeva\Masterpoint\Menu\Site as SiteMenu;

class Site extends Controller {

	public function __construct()
	{
		parent::__construct();
	}
	protected function setupLayout()
	{
		parent::setupLayout();
		$this->layout->navbar->menu = new SiteMenu;
	}

}