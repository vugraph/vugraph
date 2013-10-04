<?php namespace Odeva\Masterpoint\Model;

use Cartalyst\Sentry\Users\Eloquent\User as SentryUser;

class User extends SentryUser {

	protected $rules = array(
		'first_name'			=> 'required|between:2,30',
		'last_name'				=> 'required|between:2,30',
		'email'					=> 'required|email',
		'password'				=> 'between:6,30',
	);
}