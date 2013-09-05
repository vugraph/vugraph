<?php

class ResetPasswordValidator extends MyValidator {
	public static $rules = array(
		'email'			=> 'required|email'
	);
}