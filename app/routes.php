<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/* Registration */
Route::get('register', array('as' => 'auth.register', 'uses' => 'Tbfmp\AuthController@getRegister'));
Route::post('register', 'Tbfmp\AuthController@postRegister');
Route::get('register/success', array('as' => 'auth.register.success', 'uses' => 'Tbfmp\AuthController@getRegisterSuccess'));
Route::get('register/activate/{code}', array('as' => 'auth.register.activate', 'uses' => 'Tbfmp\AuthController@getActivate'))
	->where('code', '[A-Za-z0-9]+');
/* Login */
Route::get('login', array('as' => 'auth.login', 'uses' => 'Tbfmp\AuthController@getLogin'));
Route::post('login', 'Tbfmp\AuthController@postLogin');
/* Logout */
Route::get('logout', array('as' => 'auth.logout', 'uses' => 'Tbfmp\AuthController@getLogout'));
/* Reset Password */
Route::get('reset-password', array('as' => 'auth.login.reset-password', 'uses' => 'Tbfmp\AuthController@getResetPassword'));
Route::post('reset-password', 'Tbfmp\AuthController@postResetPassword');
Route::get('reset-password/success', array('as' => 'auth.login.reset-password.success', 'uses' => 'Tbfmp\AuthController@getResetPasswordSuccess'));
Route::get('reset-password/change/{code}', array('as' => 'auth.login.reset-password.change', 'uses' => 'Tbfmp\AuthController@getResetPasswordChange'))
	->where('code', '[A-Za-z0-9]+');
Route::post('reset-password/change/{code}', 'Tbfmp\AuthController@postResetPasswordChange')
	->where('code', '[A-Za-z0-9]+');
Route::get('reset-password/change/success', array('as' => 'auth.login.reset-password.change.success', 'uses' => 'Tbfmp\AuthController@getResetPasswordChangeSuccess'));

/* User */
Route::group(array('prefix' => 'user'), function() {
	Route::get('/', array('as' => 'user', 'uses' => 'Tbfmp\UserController@getIndex'));
	/* Account */
	Route::group(array('prefix' => 'account'), function() {
		Route::get('/', array('as' => 'user.account', 'uses' => 'Tbfmp\AccountController@getIndex'));
		Route::get('notifications', array('as' => 'user.account.notifications', 'uses' => 'Tbfmp\AccountController@getNotifications'));
		Route::get('details', array('as' => 'user.account.details', 'uses' => 'Tbfmp\AccountController@getDetails'));
		Route::post('details', 'Tbfmp\AccountController@postDetails');
		/* Account Password */
		Route::group(array('prefix' => 'password'), function() {
			Route::get('/', array('as' => 'user.account.password', 'uses' => 'Tbfmp\AccountController@getPassword'));
			Route::post('/', 'Tbfmp\AccountController@postPassword');
			Route::get('success', array('as' => 'user.account.password.success', 'uses' => 'Tbfmp\AccountController@getPasswordSuccess'));
		});
	});
	/* Club User */
	Route::group(array('prefix' => 'club'), function() {
		Route::get('/', array('as' => 'user.club', 'uses' => 'Tbfmp\ClubController@getIndex'));
		/* Tournament */
		Route::group(array('prefix' => 'tournaments'), function() {
			Route::get('/', array('as' => 'user.club.tournaments', 'uses' => 'Tbfmp\TournamentController@getIndex'));
		});
		
	});
	Route::model('club', 'Tbfmp\Club');
	/* Admin User */
	Route::group(array('prefix' => 'admin'), function() {
		Route::get('/', array('as' => 'user.admin', 'uses' => 'Tbfmp\AdminController@getIndex'));
		/* Club */
		Route::group(array('prefix' => 'clubs'), function() {
			Route::get('/', array('as' => 'user.admin.clubs.index', 'uses' => 'Tbfmp\ClubController@index'));
			Route::any('/{club}', array('as' => 'user.admin.clubs.destroy', 'uses' => 'Tbfmp\ClubController@destroy'));
			Route::get('create', array('as' => 'user.admin.clubs.create', 'uses' => 'Tbfmp\ClubController@getCreate'));
		});
	});
});

/* Player */
/*
Route::get('sporcu', 'PlayerController@getIndex');
Route::get('sporcu/lisans-bilgileri', 'PlayerController@getLisansBilgileri');
Route::get('sporcu/online-vize', 'UserController@getOnlineVize');
*/

/* Club */
/*
Route::get('kulup-yetkilisi', 'ClubUserController@getIndex');
Route::get('kulup-yetkilisi/turnuva-girisi', 'ClubUserController@getTurnuvaGirisi');
*/

/* Regional */
/*
Route::get('bolgesel-yetkili', 'RegionalUserController@getIndex');
Route::get('bolgesel-yetkili/turnuva-girisi', 'RegionalUserController@getTurnuvaGirisi');
*/
/* National */
/*
Route::get('ulusal-yetkili', 'NationalUserController@getIndex');
Route::get('ulusal-yetkili/turnuva-girisi', 'NationalUserController@getTurnuvaGirisi');
*/

/* Licence User */
/*
Route::get('lisans-yetkilisi', 'LicenceUserController@getIndex');
Route::get('lisans-yetkilisi/lisans', 'LicenceUserController@getVize');
Route::get('lisans-yetkilisi/vize', 'LicenceUserController@getVize');
*/

/* Superadmin */
/* Site */
Route::get('/', array('as' => 'home', 'uses' => 'Tbfmp\HomeController@getIndex'));
Route::get('menu1', array('as' => 'menu1', 'uses' => 'Tbfmp\HomeController@getMenu1'));
Route::get('menu2', array('as' => 'menu2', 'uses' => 'Tbfmp\HomeController@getMenu2'));
Route::get('menu2a', array('as' => 'menu2a', 'uses' => 'Tbfmp\HomeController@getMenu2a'));
Route::get('menu2b', array('as' => 'menu2b', 'uses' => 'Tbfmp\HomeController@getMenu2b'));
Route::get('menu2c', array('as' => 'menu2c', 'uses' => 'Tbfmp\HomeController@getMenu2c'));
Route::get('menu3', array('as' => 'menu3', 'uses' => 'Tbfmp\HomeController@getMenu3'));
Route::get('menu3a', array('as' => 'menu3a', 'uses' => 'Tbfmp\HomeController@getMenu3a'));
Route::get('menu3b', array('as' => 'menu3b', 'uses' => 'Tbfmp\HomeController@getMenu3b'));
Route::get('menu4', array('as' => 'menu4', 'uses' => 'Tbfmp\HomeController@getMenu4'));

//Route::controller('/', 'Tbfmp\HomeController');
/*
Route::get('/', 'HomeController@getGuncel');
Route::get('klasman', 'HomeController@getKlasman');
Route::get('genel-klasman', 'HomeController@getGenelKlasman');
Route::get('sezona-gore-klasman', 'HomeController@getSezoneGoreKlasman');
Route::get('sadece-altin-klasmani', 'HomeController@getSadeceAltinKlasmani');
Route::get('online-masterpoint-klasmani', 'HomeController@getOnlineMasterpointKlasmani');
Route::get('turnuvalar', 'HomeController@getTurnuvalar');
Route::get('federasyon-turnuvalari', 'HomeController@getFederasyonTurnuvalari');
Route::get('bolgesel-turnuvalar', 'HomeController@getBolgeselTurnuvalar');
Route::get('kulup-turnuvalari', 'HomeController@getKulupTurnuvalari');
Route::get('oyuncular', 'HomeController@getOyuncular');
Route::get('kulupler', 'HomeController@getKulupler');
Route::get('kayitli-kulupler', 'HomeController@getKayitliKulupler');
Route::get('kayitli-turnuvalar', 'HomeController@getKayitliTurnuvalar');
Route::get('kulup-istatistikleri', 'HomeController@getKulupIstatistikleri');
Route::get('yardim', 'HomeController@getYardim');
Route::get('masterpoint-kitapcigi', 'HomeController@getMasterpointKitapcigi');
Route::get('kullanim-klavuzu', 'HomeController@getKullanimKlavuzu');
Route::get('sikca-sorulan-sorular', 'HomeController@getSikcaSorulanSorular');
 * 
 */

