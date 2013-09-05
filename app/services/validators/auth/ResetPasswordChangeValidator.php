<?php

class ResetPasswordChangeValidator extends MyValidator {
	public static $rules = array(
		'password'				=> 'required|between:6,30|confirmed',
		'password_confirmation'	=> 'required|between:6,30'
	);
}