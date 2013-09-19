<?php namespace Tbfmp;

use App;
use Exception;
use Sentry;

class UserMenu extends BaseMenu {

	public function __construct($navbarclass)
	{
		parent::__construct($navbarclass);
		try {
			$this->left[] = new MenuItem('home', '<i class="icon-home icon-white"></i> '.trans('user/menu.home'));
			$user = Sentry::getUser();
			if ($user->hasAccess('club')) {
				$this->left[] = new MenuItem('user.club', trans('user/menu.club'), array(
					new MenuItem('user.club.tournaments', '<i class="icon-chevron-right"></i> '.trans('user/menu.club.tournaments'))
				));
			}
			if ($user->hasAccess('superuser')) {
				$this->left[] = new MenuItem('user.admin', trans('user/menu.admin'), array(
					new MenuItem('user.admin.clubs.index', '<i class="icon-chevron-right"></i> '.trans('user/menu.admin.manage_clubs'))
				));
			}
			$this->right = array(
				new MenuItem('user.account', '<i class="icon-user icon-white"></i> '.trim($user->first_name.' '.$user->last_name), array(
					new MenuItem('user.account.notifications', '<i class="icon-list-alt"></i> '.trans('user/menu.notifications')),
					new MenuItem('user.account.details', '<i class="icon-edit"></i> '.trans('user/menu.account_details')),
					new MenuItem('user.account.password', '<i class="icon-lock"></i> '.trans('user/menu.change_password')),
					new MenuItem('auth.logout', '<i class="icon-off"></i> '.trans('user/menu.logout'))
				)
			));
		} catch (Exception $e) {
			App::abort(500, $e->getMessage());
		}
		$this->setSelectedStatus();
	}

}