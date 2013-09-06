<?php

class UserController extends BaseController {

	protected $user;

	public function __construct()
	{
		parent::__construct();
		$this->navbar = 'layouts._partial.navbar.homemenu';
		$this->sidebar = 'layouts._partial.sidebar.usermenu';
		$this->beforeFilter('auth');
//		foreach(Config::get('access') as $path => $permission) {
//			if ($permission === '') continue;
//			if (preg_match($path, Request::path())) {
//				if (!$user->hasAccess($permission))	App::abort(401, 'Bu sayfaya erişim yetkiniz yok');
//			}
//		}
		$this->user = Sentry::getUser();
	}
	
	protected function setupLayout()
	{
		parent::setupLayout();
		$this->viewdata['user'] = $this->user;
	}
	
	public function getIndex()
	{
		$this->getHome();
	}
	
	public function getHome()
	{
		$this->showPage('user.home');
	}
	
	public function getAccountInformation()
	{
		$this->title = trans('user/account-information.title');
		$this->showPage('user.account-information');
	}
	
	public function postAccountInformation()
	{
		$validation = new AccountInformationValidator;
		if (!$validation->passes()) return Redirect::back()->onlyInput('first_name', 'last_name')->withErrors($validation->getErrors());
		$err = '';
		try {
			$this->user->first_name = trim(Input::get('first_name'));
			$this->user->last_name = trim(Input::get('last_name'));
			if ($this->user->save()) {
				return Redirect::back()->with('message-success', trans('user/account-information.success_message'));
			} else {
				$err = trans('user/account-information.error_message');
			}
		} catch (Exception $e) {
			$err = $e->getMessage();
		}
		return Redirect::back()->onlyInput('first_name', 'last_name')->with('message-error', $err);
	}
	
	public function getChangePassword()
	{
		$this->title = trans('user/change-password.title');
		$this->showPage('user.change-password');
	}
	
	public function postChangePassword()
	{
		$validation = new ChangePasswordValidator;
		if (!$validation->passes()) return Redirect::back()->withErrors($validation->getErrors());
		$err = '';
		try {
			if ($this->user->checkPassword(Input::get('current_password'))) {
				$this->user->password = Input::get('password');
				if ($this->user->save()) {
					return Redirect::route('user.change-password.success')->with('message-success', trans('user/change-password.success_message'));
				} else {
					$err = trans('user/change-password.error_message');
				}
			} else {
				$err = trans('user/change-password.wrong_password_message');
			}
		} catch (Exception $e) {
			$err = $e->getMessage();
		}
		return Redirect::back()->with('message-error', $err);
	}
	
	public function getChangePasswordSuccess()
	{
		$this->title = $this->heading = trans('user/change-password.success_title');
		$this->showPage('result');
	}
	
}