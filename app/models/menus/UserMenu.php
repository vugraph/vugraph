<?php namespace Tbfmp;

use App;
use Exception;
use Sentry;

class UserMenu extends BaseMenu {

	public function __construct()
	{
		parent::__construct('navbar navbar-fixed-top navbar-inxverse');
		try {
			$this->left[] = new MenuItem('home', '<i class="icon-home icon-white"></i> '.trans('panel/menu.home'));
			$user = Sentry::getUser();
			if ($user->hasAccess('club')) {
				$this->left[] = new MenuItem('panel.club', trans('panel/menu.club'), array(
					new MenuItem('panel.club.tournaments', '<i class="icon-chevron-right"></i> '.trans('panel/menu.club.tournaments'))
				));
			}
			if ($user->hasAccess('superuser')) {
				$this->left[] = new MenuItem('panel.admin', trans('panel/menu.admin'), array(
					new MenuItem('panel.admin.clubs.index', '<i class="icon-chevron-right"></i> '.trans('panel/menu.admin.manage_clubs'))
				));
			}
			$this->right = array(
				new MenuItem('panel.account', '<i class="icon-user icon-white"></i> '.substr(trim($user->first_name.' '.$user->last_name), 0, 20), array(
					new MenuItem('panel.account.notifications', '<i class="icon-list-alt"></i> '.trans('panel/menu.notifications')),
					new MenuItem('panel.account.details', '<i class="icon-edit"></i> '.trans('panel/menu.account_details')),
					new MenuItem('panel.account.password', '<i class="icon-lock"></i> '.trans('panel/menu.change_password')),
					new MenuItem('auth.logout', '<i class="icon-off"></i> '.trans('panel/menu.logout'))
				)
			));
		} catch (Exception $e) {
			App::abort(500, $e->getMessage());
		}
		$this->setSelectedStatus();
	}

}