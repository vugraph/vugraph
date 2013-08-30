<?php

/**
 * An Eloquent Model: 'User'
 *
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $permissions
 * @property boolean $activated
 * @property string $activation_code
 * @property \Carbon\Carbon $activated_at
 * @property \Carbon\Carbon $last_login
 * @property string $persist_code
 * @property string $reset_password_code
 * @property string $first_name
 * @property string $last_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $old_usernames
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cartalyst\Sentry\Groups\Eloquent\Group[] $groups
 */
class User extends Cartalyst\Sentry\Users\Eloquent\User {

	public static $rules = array(
		'first_name'		=> 'required|between:2,30',
		'last_name'			=> 'required|between:2,30',
		'email'				=> 'required|email',
		'password'			=> 'required|alpha_num|between:6,30|confirmed',
		'password_confirm'	=> 'required|alpha_num|between:6,30'
	);

}