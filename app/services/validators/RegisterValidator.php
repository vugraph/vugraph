<?php

class RegisterValidator extends MyValidator {
	public static $rules = array(
		'first_name'			=> 'required|between:2,30',
		'last_name'				=> 'required|between:2,30',
		'email'					=> 'required|email|unique:users',
		'password'				=> 'required|alpha_num|between:6,30|confirmed',
		'password_confirmation'	=> 'required|alpha_num|between:6,30'
	);
}