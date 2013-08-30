<?php

class UserController extends BaseController {

	protected $user;

	public function __construct(User $user)
	{
		parent::__construct();
		$this->beforeFilter('auth');
		foreach(Config::get('access') as $path => $permission) {
			if ($permission === '') continue;
			if (preg_match($path, Request::path())) {
				if (!$user->hasAccess($permission))	App::abort(401, 'Bu sayfaya erişim yetkiniz yok');
			}
		}
		$this->user = $user;
	}
	
	public function getIndex()
	{
		return 'Kullanıcı ana sayfa';
	}
	
}