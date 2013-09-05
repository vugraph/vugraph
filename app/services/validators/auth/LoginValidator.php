<?php

class LoginValidator extends MyValidator {
	public static $rules = array(
		'email'			=> 'required|email',
		'password'		=> 'required',
	);
}