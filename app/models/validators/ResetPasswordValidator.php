<?php namespace Tbfmp;

class ResetPasswordValidator extends BaseValidator {
	public static $rules = array(
		'email'			=> 'required|email'
	);
}