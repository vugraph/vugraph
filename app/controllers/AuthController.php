<?php

/**
 * Authentication Tasks like Login, Logout, Register...
 *
 * @author bshan
 */
class AuthController extends BaseController {

	public function __construct() {
		parent::__construct();
		$this->navbar = 'layouts._partial.navbar.homemenu';
//		$this->breadcrumb = 'layouts._partial.navbar.breadcrumb';
	}
	/**
	 * Login page
	 * @return View
	 */
	public function getRegister()
	{
		$this->title = trans('auth/register.title');
		$this->showPage('auth.register');
	}
	
	public function postRegister()
	{
		$validation = new RegisterValidator;
		if ($validation->passes()) {
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
					return Redirect::route('auth.register.success');
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
		return Redirect::back()->exceptInput('password', 'password_confirmation')->withErrors($validation->getErrors());
	}
	
	public function getRegisterSuccess()
	{
		$this->title = $this->heading = trans('auth/register.success_title');
		Session::put('message-success', trans('auth/register.success_content'));
		$this->showPage('result');
	}

	public function getActivate($code)
	{
		$msg = '';
		try {
			$user = Sentry::getUserProvider()->findByActivationCode($code);
			if ($user->attemptActivation($code)) {
				return Redirect::route('auth.login')->with('message-success', trans('auth/register.activate_success'));
			} else {
				$msg = 'unknown error';
			}
		} catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
			$msg = trans('auth/register.activate_error_content');
		} catch (Cartalyst\SEntry\Users\UserAlreadyActivatedException $e) {
			$msg = trans('auth/register.activate_already_activated');
		} catch (Exception $e) {
			$msg = $e->getMessage();
		}
		$this->title = $this->heading = trans('auth/register.activate_error_title');
		Session::put('message-error', $msg);
		$this->showPage('result', array('message-error'));
		//, array('errors' => new Illuminate\Support\MessageBag($msg)));

	}
	
	public function getLogin()
	{
		$this->title = trans('auth/login.title');
		$this->showPage('auth.login');
	}
	
	public function postLogin()
	{
		return 'post-login';
	}

}