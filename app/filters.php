<?php

use Odeva\Masterpoint\Model\User;
/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (!Sentry::check()) {
		Session::put('loginRedirect', Request::fullUrl());
		return Redirect::route('auth.login');
    }

});

Route::filter('auth.player', function()
{
	$user = Sentry::getUser();
	if (!($user instanceof User) || !$user->player_id) App::abort(403, 'You\'re not authorized to use this page.');
});

Route::filter('auth.club', function()
{
	$user = Sentry::getUser();
	if (!($user instanceof User) || !$user->club_id) App::abort(403, 'You\'re not authorized to use this page.');
});

Route::filter('auth.city', function()
{
	$user = Sentry::getUser();
	if (!($user instanceof User) || !$user->city_id) App::abort(403, 'You\'re not authorized to use this page.');
});

Route::filter('auth.regional', function()
{
	$user = Sentry::getUser();
	if (!($user instanceof User) || !$user->region_id) App::abort(403, 'You\'re not authorized to use this page.');
});

Route::filter('auth.licence', function()
{
	$user = Sentry::getUser();
	if (!($user instanceof User) || !$user->is_licenceadmin) App::abort(403, 'You\'re not authorized to use this page.');
});

Route::filter('auth.admin', function()
{
	$user = Sentry::getUser();
	if (!($user instanceof User) || !$user->is_admin) App::abort(403, 'You\'re not authorized to use this page.');
});

Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});