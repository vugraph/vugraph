<?php namespace Odeva\Masterpoint\Menu;

use App;
use Odeva\Masterpoint\Model\User;

class Panel extends Menu {

	public function __construct(User $user)
	{
		parent::__construct('navbar navbar-fixed-top navbar-inxverse');
		try {
			$this->left[] = new Item('home', '<i class="icon-home icon-white"></i> '.trans('panel/menu.home'));
			if ($user->auth_club) {
				$this->left[] = new Item('panel.club', trans('panel/menu.club'), array(
					new Item('panel.club.tournaments', '<i class="icon-chevron-right"></i> '.trans('panel/menu.club.tournaments'))
				));
			}
			if ($user->auth_admin) {
				$this->left[] = new Item('panel.admin', trans('panel/menu.admin'), array(
					new Item('panel.admin.users.index', '<i class="icon-chevron-right"></i> '.trans('panel/menu.admin.manage_users')),
					new Item('panel.admin.clubs.index', '<i class="icon-chevron-right"></i> '.trans('panel/menu.admin.manage_clubs'))
				));
			}
			$this->right = array(
				new Item('panel.account', '<i class="icon-user icon-white"></i> '.substr(trim($user->first_name.' '.$user->last_name), 0, 20), array(
					new Item('panel.account.notifications', '<i class="icon-list-alt"></i> '.trans('panel/menu.notifications')),
					new Item('panel.account.details', '<i class="icon-edit"></i> '.trans('panel/menu.account_details')),
					new Item('panel.account.password', '<i class="icon-lock"></i> '.trans('panel/menu.change_password')),
					new Item('auth.logout', '<i class="icon-off"></i> '.trans('panel/menu.logout'))
				)
			));
		} catch (\Exception $e) {
			App::abort(500, $e->getMessage());
		}
		$this->setSelectedStatus();
	}

}