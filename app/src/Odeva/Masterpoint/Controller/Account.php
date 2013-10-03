<?php namespace Odeva\Masterpoint\Controller;

use Exception;
use Input;
use Redirect;
use Validator;

class Account extends Panel {
	
	public function getIndex()
	{
		return Redirect::route('panel.account.notifications');
	}

	public function getNotifications()
	{
		$this->title = trans('panel/account/notifications.title');
		$this->nest('panel.account.notifications');
	}

	public function getDetails()
	{
		$this->title = trans('panel/account/details.title');
		$this->nest('panel.account.details', array('user' => $this->user));
	}
	
	public function postDetails()
	{
		$rules = array(
			'first_name'			=> 'required|between:2,30',
			'last_name'				=> 'required|between:2,30'
		);
		$validator = Validator::make(Input::all(), $rules);
		$validator->setAttributeNames(trans('panel/account/details.labels'));
		if ($validator->fails()) return Redirect::back()->onlyInput('first_name', 'last_name')->withErrors($validator->messages());
		$err = '';
		try {
			$this->user->first_name = trim(Input::get('first_name'));
			$this->user->last_name = trim(Input::get('last_name'));
			if ($this->user->save()) {
				return Redirect::back()->with('message-success', trans('panel/account/details.success_message'));
			} else {
				$err = trans('panel/account/details.error_message');
			}
		} catch (Exception $e) {
			$err = $e->getMessage();
		}
		return Redirect::back()->onlyInput('first_name', 'last_name')->with('message-error', $err);
	}
	
	public function getPassword()
	{
		$this->title = trans('panel/account/password.title');
		$this->nest('panel.account.password');
	}
	
	public function postPassword()
	{
		$rules = array(
			'current_password'			=> 'required',
			'new_password'				=> 'required|between:6,30|confirmed',
			'new_password_confirmation'	=> 'required|between:6,30'
		);
		$validator = Validator::make(Input::all(), $rules);
		$validator->setAttributeNames(trans('panel/account/password.labels'));
		if ($validator->fails()) return Redirect::back()->withErrors($validator->messages());
		$err = '';
		try {
			if ($this->user->checkPassword(Input::get('current_password'))) {
				$this->user->password = Input::get('new_password');
				if ($this->user->save()) {
					return Redirect::route('panel.account.password.success')->with('message-success', trans('panel/account/password.success_message'));
				} else {
					$err = trans('panel/account/password.error_message');
				}
			} else {
				$err = trans('panel/account/password.wrong_password_message');
			}
		} catch (Exception $e) {
			$err = $e->getMessage();
		}
		return Redirect::back()->with('message-error', $err);
	}
	
	public function getPasswordSuccess()
	{
		$this->title = $this->heading = trans('panel/account/password.success_title');
		$this->nest('result');
	}
	
}