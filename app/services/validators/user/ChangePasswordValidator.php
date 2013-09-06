<?php

class ChangePasswordValidator extends MyValidator {
	public static $rules = array(
		'current_password'		=> 'required',
		'password'				=> 'required|between:6,30|confirmed',
		'password_confirmation'	=> 'required|between:6,30'
	);
}