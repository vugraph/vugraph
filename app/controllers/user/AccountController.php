<?php namespace Tbfmp;

use Exception;
use Input;
use Redirect;
use Request;

class AccountController extends UserController {
	public function getIndex()
	{
		return Redirect::route('user.account.notifications');
	}
	
	public function getNotifications()
	{
		$this->showPage('user.account.notifications');
	}
	public function getDetails()
	{
		$this->title = trans('user/account/details.title');
		$this->showPage('user.account/details');
	}
	
	public function postDetails()
	{
		$validation = new AccountInformationValidator;
		if (!$validation->passes()) return Redirect::back()->onlyInput('first_name', 'last_name')->withErrors($validation->getErrors());
		$err = '';
		try {
			$this->user->first_name = trim(Input::get('first_name'));
			$this->user->last_name = trim(Input::get('last_name'));
			if ($this->user->save()) {
				return Redirect::back()->with('message-success', trans('user/account/details.success_message'));
			} else {
				$err = trans('user/account/details.error_message');
			}
		} catch (Exception $e) {
			$err = $e->getMessage();
		}
		return Redirect::back()->onlyInput('first_name', 'last_name')->with('message-error', $err);
	}
	
	public function getPassword()
	{
		$this->title = trans('user/account/password.title');
		$this->showPage('user.account.password');
	}
	
	public function postPassword()
	{
		$validation = new ChangePasswordValidator;
		if (!$validation->passes()) return Redirect::back()->withErrors($validation->getErrors());
		$err = '';
		try {
			if ($this->user->checkPassword(Input::get('current_password'))) {
				$this->user->password = Input::get('password');
				if ($this->user->save()) {
					return Redirect::route('user.account.password.success')->with('message-success', trans('user/account/password.success_message'));
				} else {
					$err = trans('user/account/password.error_message');
				}
			} else {
				$err = trans('user/account/password.wrong_password_message');
			}
		} catch (Exception $e) {
			$err = $e->getMessage();
		}
		return Redirect::back()->with('message-error', $err);
	}
	
	public function getPasswordSuccess()
	{
		$this->title = trans('user/account/password.success_title');
		$this->showPage('result');
	}
	
}