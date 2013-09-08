<?php namespace Tbfmp;

class LoginValidator extends BaseValidator {
	public static $rules = array(
		'email'			=> 'required|email',
		'password'		=> 'required',
	);
}