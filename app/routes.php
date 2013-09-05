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

//Route::resource('players', 'PlayersController');

/* Authorization */
Route::get('login', array('as' => 'auth.login', 'uses' => 'AuthController@getLogin'));
Route::post('login', 'AuthController@postLogin');
Route::get('logout', array('as' => 'auth.logout', 'uses' => 'AuthController@getLogout'));
Route::get('register', array('as' => 'auth.register', 'uses' => 'AuthController@getRegister'));
Route::post('register', 'AuthController@postRegister');
Route::get('register/success', array('as' => 'auth.register.success', 'uses' => 'AuthController@getRegisterSuccess'));
Route::get('register/activate/{code}', array('as' => 'auth.register.activate', 'uses' => 'AuthController@getActivate'))
	->where('code', '[A-Za-z0-9]+');
Route::get('reset-password', array('as' => 'auth.login.reset-password', 'uses' => 'AuthController@getResetPassword'));
Route::post('reset-password', 'AuthController@postResetPassword');
Route::get('reset-password/success', array('as' => 'auth.login.reset-password.success', 'uses' => 'AuthController@getResetPasswordSuccess'));
Route::get('reset-password/change/{code}', array('as' => 'auth.login.reset-password.change', 'uses' => 'AuthController@getResetPasswordChange'))
	->where('code', '[A-Za-z0-9]+');
Route::post('reset-password/change/{code}', 'AuthController@postResetPasswordChange')
	->where('code', '[A-Za-z0-9]+');
Route::get('reset-password/change/success', array('as' => 'auth.login.reset-password.change.success', 'uses' => 'AuthController@getResetPasswordChangeSuccess'));

/* User */
Route::group(array('prefix' => 'user'), function() {
	Route::get('/', array('as' => 'user.home', 'uses' => 'UserController@getIndex'));
	Route::get('accout-information', array('as' => 'user.account', 'uses' => 'UserController@getAccountInformation'));
	Route::get('change-password', array('as' => 'user.password', 'uses' => 'UserController@getChangePassword'));
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
Route::group(array('prefix' => 'admin'), function() {
	Route::get('admin', 'AdminController@getIndex');
});

/* Site */
Route::get('/', array('as' => 'home', 'uses' => 'HomeController@getIndex'));
Route::get('menu1', array('as' => 'menu1', 'uses' => 'HomeController@getMenu1'));
Route::get('menu2', array('as' => 'menu2', 'uses' => 'HomeController@getMenu2'));
Route::get('menu2a', array('as' => 'menu2a', 'uses' => 'HomeController@getMenu2a'));
Route::get('menu2b', array('as' => 'menu2b', 'uses' => 'HomeController@getMenu2b'));
Route::get('menu2c', array('as' => 'menu2c', 'uses' => 'HomeController@getMenu2c'));
Route::get('menu3', array('as' => 'menu3', 'uses' => 'HomeController@getMenu3'));
Route::get('menu3a', array('as' => 'menu3a', 'uses' => 'HomeController@getMenu3a'));
Route::get('menu3b', array('as' => 'menu3b', 'uses' => 'HomeController@getMenu3b'));
Route::get('menu4', array('as' => 'menu4', 'uses' => 'HomeController@getMenu4'));
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

