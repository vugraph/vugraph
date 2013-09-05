<?php

class RegisterValidator extends MyValidator {
	public static $rules = array(
		'first_name'			=> 'required|between:2,30',
		'last_name'				=> 'required|between:2,30',
		'email'					=> 'required|email|unique:users',
		'password'				=> 'required|between:6,30|confirmed',
		'password_confirmation'	=> 'required|between:6,30'
	);
}