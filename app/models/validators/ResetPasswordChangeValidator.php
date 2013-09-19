<?php namespace Tbfmp;

class ResetPasswordChangeValidator extends BaseValidator {
	public static $rules = array(
		'password'				=> 'required|between:6,30|confirmed',
		'password_confirmation'	=> 'required|between:6,30'
	);
}