<?php

class AccountInformationValidator extends MyValidator {
	public static $rules = array(
		'first_name'			=> 'required|between:2,30',
		'last_name'				=> 'required|between:2,30'
	);
}