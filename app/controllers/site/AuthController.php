<?php namespace Tbfmp;

use Exception;
use Input;
use Redirect;
use Session;
use Sentry;
use Validator;
use Cartalyst\Sentry\Users\UserNotFoundException;
use Cartalyst\Sentry\Users\WrongPasswordException;
use Cartalyst\Sentry\Users\UserNotActivatedException;
use Cartalyst\Sentry\Throttling\UserSuspendedException;
use Cartalyst\Sentry\Throttling\UserBannedException;

class AuthController extends SiteController {

	public function getRegister()
	{
		$this->page = new FormPage(trans('auth/register.title'));
		$this->_show('auth.register');
	}
	
	public function postRegister()
	{
		$rules = array(
			'first_name'			=> 'required|between:2,30',
			'last_name'				=> 'required|between:2,30',
			'email'					=> 'required|email|unique:users',
			'password'				=> 'required|between:6,30|confirmed',
			'password_confirmation'	=> 'required|between:6,30'
		);
		$validator = Validator::make(Input::all(), $rules);
		$validator->setAttributeNames(trans('auth/register.labels'));
		if ($validator->fails()) return Redirect::back()->onlyInput('first_name', 'last_name', 'email')->withErrors($validator->messages());
		try {
			$user = Sentry::register(array(
				'first_name' => trim(Input::get('first_name')),
				'last_name' => trim(Input::get('last_name')),
				'email' => trim(Input::get('email')),
				'password' => Input::get('password')
			));
		} catch (Exception $e) {
			return Redirect::back()->onlyInput('first_name', 'last_name', 'email')->with('message-error', $e->getMessage());
		}
		try {
			$mailer = new UserMailer($user);
			if ($mailer->activate($user->getActivationCode())->deliver()) {
				return Redirect::route('auth.register.success')->with('message-success', trans('auth/register.success_message'));
			} else {
				$user->delete();
				return Redirect::back()->onlyInput('first_name', 'last_name', 'email')->with('message-error', trans('auth/register.error_sending_email'));
			}
		} catch (Exception $e) {
			$user->delete();
			return Redirect::back()->onlyInput('first_name', 'last_name', 'email')->with('message-error', $e->getMessage());
		}
		return Redirect::route('auth.register.success');
	}
	
	public function getRegisterSuccess()
	{
		$this->page = new Page(trans('auth/register.success_title'));
		$this->page->setHeading();
		$this->page->withInfo(trans('auth/register.success_content'));
		$this->_show('result');
	}

	public function getActivate($code)
	{
		$err = '';
		try {
			$user = Sentry::findUserByActivationCode($code);
			if ($user->attemptActivation($code)) {
				Session::flashInput(array('email' => $user->email));
				return Redirect::route('auth.login')->with('message-success', trans('auth/register.activate_success'));
			} else {
				$err = 'unknown error';
			}
		} catch (UserNotFoundException $e) {
			$err = trans('auth/register.activate_error_content');
		} catch (Exception $e) {
			$err = $e->getMessage();
		}
		$this->page = new Page(trans('auth/register.activate_error_title'));
		$this->page->withError($err);
		$this->_show('result');
	}

	public function getLogin()
	{
		$this->page = new FormPage(trans('auth/login.title'));
		$this->_show('auth.login');
	}
	
	public function postLogin()
	{
		$rules = array(
			'email'			=> 'required|email',
			'password'		=> 'required',
		);
		$validator = Validator::make(Input::all(), $rules);
		$validator->setAttributeNames(trans('auth/login.labels'));
		if ($validator->fails()) return Redirect::back()->onlyInput('email')->withErrors($validator->messages());
		$err = '';
		try {
			$user = Sentry::authenticate(
				array(
					'email' => trim(Input::get('email')),
					'password' => Input::get('password')
				),
				false
			);
			return Redirect::route('panel.account.notifications');
		} catch (WrongPasswordException $e) {
			$err = trans('auth/login.invalid_credentials');
		} catch (UserNotFoundException $e) {
			$err = trans('auth/login.invalid_credentials');
		} catch (UserNotActivatedException $e) {
			$err = trans('auth/login.user_not_activated');
		} catch (UserSuspendedException $e) {
			$err = trans('auth/login.user_suspended');
		} catch (UserBannedException $e) {
			$err = trans('auth/login.user_banned');
		} catch (Exception $e) {
			$err = $e->getMessage();
		}
		return Redirect::back()->onlyInput('email')->with('message-error', $err);
	}
	
	public function getLogout()
	{
		Sentry::logout();
		return Redirect::home();
	}
	
	public function getResetPassword()
	{
		$this->page = new FormPage(trans('auth/reset-password.title'));
		$this->_show('auth.reset-password');
	}

	public function postResetPassword()
	{
		$rules = array('email' => 'required|email');
		$validator = Validator::make(Input::all(), $rules);
		$validator->setAttributeNames(trans('auth/reset-password.labels'));
		if ($validator->fails()) return Redirect::back()->onlyInput('email')->withErrors($validator->messages());
		$err = '';
		try {
			$user = Sentry::findUserByLogin(trim(Input::get('email')));
			$mailer = new UserMailer($user);
			if ($mailer->resetPassword($user->getResetPasswordCode())->deliver()) {
				return Redirect::route('auth.login.reset-password.success')->with('message-success', trans('auth/reset-password.success_message'));
			} else {
				$err = trans('auth/reset-password.error_sending_email');
			}
		} catch (UserNotFoundException $e) {
			$err = trans('auth/reset-password.email_not_found');
		}
		return Redirect::back()->onlyInput('email')->with('message-error', $err);
	}
	
	public function getResetPasswordSuccess()
	{
		$this->page = new Page(trans('auth/reset-password.success_title'));
		$this->page->setHeading();
		$this->page->withInfo(trans('auth/reset-password.success_content'));
		$this->_show('result');
	}
	
	public function getResetPasswordChange($code)
	{
		$err = '';
		try {
			$user = Sentry::findUserByResetPasswordCode($code);
		} catch (UserNotFoundException $e) {
			$err = trans('auth/reset-password.change_error_content');
		} catch (Exception $e) {
			$err = $e->getMessage();
		}
		if (empty($err)) {
			$this->page = new Page(trans('auth/reset-password.change_title'));
			$this->_show('auth.reset-password-change');
		} else {
			$this->page = new Page(trans('auth/reset-password.change_error_title'));
			$this->page->withError($err);
			$this->_show('result');
		}
	}
	
	public function postResetPasswordChange($code)
	{
		$rules = array(
			'password'				=> 'required|between:6,30|confirmed',
			'password_confirmation'	=> 'required|between:6,30'
		);
		$validator = Validator::make(Input::all(), $rules);
		$validator->setAttributeNames(trans('auth/reset-password.labels'));
		if ($validator->fails()) return Redirect::back()->withErrors($validator->messages());
		try {
			$user = Sentry::findUserByResetPasswordCode($code);
			if (!$user->attemptResetPassword($code, Input::get('password'))) {
				$err = trans('auth/reset-password.change_error_message');
			}
		} catch (UserNotFoundException $e) {
			$err = trans('auth/reset-password.change_error_content');
		} catch (Exception $e) {
			$err = $e->getMessage();
		}
		if (empty($err)) {
			Sentry::logout();
			return Redirect::route('auth.login')->with('message-success', trans('auth/reset-password.change_success_message'));
		} else {
			return Redirect::back()->with('message-error', $err);
		}
	}

}