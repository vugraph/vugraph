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
Route::get('register', array('as' => 'auth.register', 'uses' => 'Odeva\Masterpoint\Controller\Auth@getRegister'));
Route::post('register', 'Odeva\Masterpoint\Controller\Auth@postRegister');
Route::get('register/success', array('as' => 'auth.register.success', 'uses' => 'Odeva\Masterpoint\Controller\Auth@getRegisterSuccess'));
Route::get('register/activate/{code}', array('as' => 'auth.register.activate', 'uses' => 'Odeva\Masterpoint\Controller\Auth@getActivate'))
	->where('code', '[A-Za-z0-9]+');
/* Login */
Route::get('login', array('as' => 'auth.login', 'uses' => 'Odeva\Masterpoint\Controller\Auth@getLogin'));
Route::post('login', 'Odeva\Masterpoint\Controller\Auth@postLogin');
/* Logout */
Route::get('logout', array('as' => 'auth.logout', 'uses' => 'Odeva\Masterpoint\Controller\Auth@getLogout'));
/* Reset Password */
Route::get('reset-password', array('as' => 'auth.login.reset-password', 'uses' => 'Odeva\Masterpoint\Controller\Auth@getResetPassword'));
Route::post('reset-password', 'Odeva\Masterpoint\Controller\Auth@postResetPassword');
Route::get('reset-password/success', array('as' => 'auth.login.reset-password.success', 'uses' => 'Odeva\Masterpoint\Controller\Auth@getResetPasswordSuccess'));
Route::get('reset-password/change/{code}', array('as' => 'auth.login.reset-password.change', 'uses' => 'Odeva\Masterpoint\Controller\Auth@getResetPasswordChange'))
	->where('code', '[A-Za-z0-9]+');
Route::post('reset-password/change/{code}', 'Odeva\Masterpoint\Controller\Auth@postResetPasswordChange')
	->where('code', '[A-Za-z0-9]+');

/* User */
Route::group(array('prefix' => 'panel'), function() {
	Route::get('/', array('as' => 'panel', 'uses' => 'Odeva\Masterpoint\Controller\Panel@getIndex'));
	/* Account */
	Route::group(array('prefix' => 'account'), function() {
		Route::get('/', array('as' => 'panel.account', 'uses' => 'Odeva\Masterpoint\Controller\Account@getIndex'));
		Route::get('notifications', array('as' => 'panel.account.notifications', 'uses' => 'Odeva\Masterpoint\Controller\Account@getNotifications'));
		Route::get('details', array('as' => 'panel.account.details', 'uses' => 'Odeva\Masterpoint\Controller\Account@getDetails'));
		Route::post('details', 'Odeva\Masterpoint\Controller\Account@postDetails');
		/* Account Password */
		Route::group(array('prefix' => 'password'), function() {
			Route::get('/', array('as' => 'panel.account.password', 'uses' => 'Odeva\Masterpoint\Controller\Account@getPassword'));
			Route::post('/', 'Odeva\Masterpoint\Controller\Account@postPassword');
			Route::get('success', array('as' => 'panel.account.password.success', 'uses' => 'Odeva\Masterpoint\Controller\Account@getPasswordSuccess'));
		});
	});
	/* Club User */
	Route::group(array('prefix' => 'club'), function() {
		Route::get('/', array('as' => 'panel.club', 'uses' => 'Odeva\Masterpoint\Controller\Club@getIndex'));
		/* Tournament */
		Route::group(array('prefix' => 'tournaments'), function() {
			Route::get('/', array('as' => 'panel.club.tournaments', 'uses' => 'Odeva\Masterpoint\Controller\Tournament@getIndex'));
		});
		
	});
	Route::model('club', 'Odeva\Masterpoint\Model\Club');
	/* Admin User */
	Route::group(array('prefix' => 'admin'), function() {
		Route::get('/', array('as' => 'panel.admin', 'uses' => 'Odeva\Masterpoint\Controller\Admin@getIndex'));
		/* Club */
		Route::group(array('prefix' => 'clubs'), function() {
			Route::any('/', array('as' => 'panel.admin.clubs.index', 'uses' => 'Odeva\Masterpoint\Controller\Clubs@index'));
			Route::any('/{club}', array('as' => 'panel.admin.clubs.destroy', 'uses' => 'Odeva\Masterpoint\Controller\Clubs@destroy'));
			Route::get('/{club}/edit', array('as' => 'panel.admin.clubs.edit', 'uses' => 'Odeva\Masterpoint\Controller\Clubs@edit'));
			Route::get('create', array('as' => 'panel.admin.clubs.create', 'uses' => 'Odeva\Masterpoint\Controller\Clubs@getCreate'));
		});
	});
});

/* Player */
/*
Route::get('sporcu', 'Player@getIndex');
Route::get('sporcu/lisans-bilgileri', 'Player@getLisansBilgileri');
Route::get('sporcu/online-vize', 'Panel@getOnlineVize');
*/

/* Club */
/*
Route::get('kulup-yetkilisi', 'ClubUser@getIndex');
Route::get('kulup-yetkilisi/turnuva-girisi', 'ClubUser@getTurnuvaGirisi');
*/

/* Regional */
/*
Route::get('bolgesel-yetkili', 'RegionalUser@getIndex');
Route::get('bolgesel-yetkili/turnuva-girisi', 'RegionalUser@getTurnuvaGirisi');
*/
/* National */
/*
Route::get('ulusal-yetkili', 'NationalUser@getIndex');
Route::get('ulusal-yetkili/turnuva-girisi', 'NationalUser@getTurnuvaGirisi');
*/

/* Licence User */
/*
Route::get('lisans-yetkilisi', 'LicenceUser@getIndex');
Route::get('lisans-yetkilisi/lisans', 'LicenceUser@getVize');
Route::get('lisans-yetkilisi/vize', 'LicenceUser@getVize');
*/

/* Superadmin */
/* Site */
Route::get('/', array('as' => 'home', 'uses' => 'Odeva\Masterpoint\Controller\Home@getIndex'));
Route::get('menu1', array('as' => 'menu1', 'uses' => 'Odeva\Masterpoint\Controller\Home@getMenu1'));
Route::get('menu2', array('as' => 'menu2', 'uses' => 'Odeva\Masterpoint\Controller\Home@getMenu2'));
Route::get('menu2a', array('as' => 'menu2a', 'uses' => 'Odeva\Masterpoint\Controller\Home@getMenu2a'));
Route::get('menu2b', array('as' => 'menu2b', 'uses' => 'Odeva\Masterpoint\Controller\Home@getMenu2b'));
Route::get('menu2c', array('as' => 'menu2c', 'uses' => 'Odeva\Masterpoint\Controller\Home@getMenu2c'));
Route::get('menu3', array('as' => 'menu3', 'uses' => 'Odeva\Masterpoint\Controller\Home@getMenu3'));
Route::get('menu3a', array('as' => 'menu3a', 'uses' => 'Odeva\Masterpoint\Controller\Home@getMenu3a'));
Route::get('menu3b', array('as' => 'menu3b', 'uses' => 'Odeva\Masterpoint\Controller\Home@getMenu3b'));
Route::get('menu4', array('as' => 'menu4', 'uses' => 'Odeva\Masterpoint\Controller\Home@getMenu4'));

//Route::controller('/', 'Odeva\Masterpoint\Controller\HomeController');
/*
Route::get('/', 'Home@getGuncel');
Route::get('klasman', 'Home@getKlasman');
Route::get('genel-klasman', 'Home@getGenelKlasman');
Route::get('sezona-gore-klasman', 'Home@getSezoneGoreKlasman');
Route::get('sadece-altin-klasmani', 'Home@getSadeceAltinKlasmani');
Route::get('online-masterpoint-klasmani', 'Home@getOnlineMasterpointKlasmani');
Route::get('turnuvalar', 'Home@getTurnuvalar');
Route::get('federasyon-turnuvalari', 'Home@getFederasyonTurnuvalari');
Route::get('bolgesel-turnuvalar', 'Home@getBolgeselTurnuvalar');
Route::get('kulup-turnuvalari', 'Home@getKulupTurnuvalari');
Route::get('oyuncular', 'Home@getOyuncular');
Route::get('kulupler', 'Home@getKulupler');
Route::get('kayitli-kulupler', 'Home@getKayitliKulupler');
Route::get('kayitli-turnuvalar', 'Home@getKayitliTurnuvalar');
Route::get('kulup-istatistikleri', 'Home@getKulupIstatistikleri');
Route::get('yardim', 'Home@getYardim');
Route::get('masterpoint-kitapcigi', 'Home@getMasterpointKitapcigi');
Route::get('kullanim-klavuzu', 'Home@getKullanimKlavuzu');
Route::get('sikca-sorulan-sorular', 'Home@getSikcaSorulanSorular');
 * 
 */

Route::controller('', 'Odeva\Masterpoint\Controller\Home');
