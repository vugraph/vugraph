<?php namespace Odeva\Masterpoint\Controller;

use Input;
use Redirect;
use Sentry;
use Session;
use Odeva\Masterpoint\Menu\Panel as PanelMenu;
use Odeva\Masterpoint\Menu\Site as SiteMenu;
use Odeva\Masterpoint\Model\User;

class Panel extends Controller {

	public function __construct()
	{
		parent::__construct();
		$this->beforeFilter('auth');
		$this->user = Sentry::getUser();
	}

	protected function setupLayout()
	{
		parent::setupLayout();
		$this->layout->navbar->menu = ($this->user instanceof User) ? new PanelMenu($this->user) : new SiteMenu;
	}
	
	public function getIndex()
	{
		return Redirect::route('panel.account.notifications');
	}

	public function postPerPage()
	{
		$perPage = intval(Input::get('perpage'));
		$table = Input::get('table');
		if ($perPage > 0) Session::put('prefs.'.$table.'.perPage', $perPage);
		return Redirect::back();
	}

}