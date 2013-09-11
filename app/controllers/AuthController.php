<?php namespace Tbfmp;

use Exception;
use Input;
use Redirect;
use Session;
use Sentry;
use Cartalyst\Sentry\Users\UserNotFoundException;
use Cartalyst\Sentry\Users\WrongPasswordException;
use Cartalyst\Sentry\Users\UserNotActivatedException;
use Cartalyst\Sentry\Throttling\UserSuspendedException;
use Cartalyst\Sentry\Throttling\UserBannedException;

class AuthController extends BaseController {

	public function __construct() {
		parent::__construct();
//		$this->navbar = 'layouts._partial.navbar.menu';
//		$this->breadcrumb = 'layouts._partial.navbar.breadcrumb';
	}

	public function getRegister()
	{
		$this->title = trans('auth/register.title');
		$this->showPage('auth.register');
	}
	
	public function postRegister()
	{
		$validation = new RegisterValidator;
		if (!$validation->passes()) return Redirect::back()->exceptInput('password', 'password_confirmation')->withErrors($validation->getErrors());
		try {
			$user = Sentry::register(array(
				'first_name' => trim(Input::get('first_name')),
				'last_name' => trim(Input::get('last_name')),
				'email' => trim(Input::get('email')),
				'password' => Input::get('password')
			));
		} catch (Exception $e) {
			return Redirect::back()->exceptInput('password', 'password_confirmation')->with('message-error', $e->getMessage());
		}
		try {
			$mailer = new UserMailer($user);
			if ($mailer->activate($user->getActivationCode())->deliver()) {
				return Redirect::route('auth.register.success')->with('message-success', trans('auth/register.success_message'));
			} else {
				$user->delete();
				return Redirect::back()->exceptInput('password', 'password_confirmation')->with('message-error', trans('auth/register.error_sending_email'));
			}
		} catch (Exception $e) {
			$user->delete();
			return Redirect::back()->exceptInput('password', 'password_confirmation')->with('message-error', $e->getMessage());
		}
		return Redirect::route('auth.register.success');
	}
	
	public function getRegisterSuccess()
	{
		$this->title = trans('auth/register.success_title');
		$this->withInfo(trans('auth/register.success_content'));
		$this->showPage('result');
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
		$this->title = trans('auth/register.activate_error_title');
		$this->withError($err);
		$this->showPage('result');
	}

	public function getLogin()
	{
		$this->title = trans('auth/login.title');
		$this->showPage('auth.login');
	}
	
	public function postLogin()
	{
		$validation = new LoginValidator;
		if (!$validation->passes()) return Redirect::back()->exceptInput('password')->withErrors($validation->getErrors());
		$err = '';
		try {
			$user = Sentry::authenticate(
				array(
					'email' => trim(Input::get('email')),
					'password' => Input::get('password')
				),
				false
			);
			return Redirect::route('user.account.notifications');
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
		return Redirect::back()->exceptInput('password')->with('message-error', $err);
	}
	
	public function getLogout()
	{
		Sentry::logout();
		return Redirect::home();
	}
	
	public function getResetPassword()
	{
		$this->title = trans('auth/reset-password.title');
		$this->showPage('auth.reset-password');
	}

	public function postResetPassword()
	{
		$validation = new ResetPasswordValidator;
		if (!$validation->passes()) return Redirect::back()->onlyInput('email')->withErrors($validation->getErrors());
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
		$this->title = trans('auth/reset-password.success_title');
		$this->withInfo(trans('auth/reset-password.success_content'));
		$this->showPage('result');
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
			$this->title = trans('auth/reset-password.change_title');			
			$this->showPage('auth.reset-password-change');
		} else {
			$this->title = trans('auth/reset-password.change_error_title');
			$this->withError($err);
			$this->showPage('result');
		}
	}
	
	public function postResetPasswordChange($code)
	{
		$validation = new ResetPasswordChangeValidator;
		if (!$validation->passes()) return Redirect::back()->withErrors($validation->getErrors());
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