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
Route::get('register', array('as' => 'auth.register', 'uses' => 'Odeva\Masterpoint\Controller\Site\Auth@getRegister'));
Route::post('register', 'Odeva\Masterpoint\Controller\Site\Auth@postRegister');
Route::get('register/success', array('as' => 'auth.register.success', 'uses' => 'Odeva\Masterpoint\Controller\Site\Auth@getRegisterSuccess'));
Route::get('register/activate/{code}', array('as' => 'auth.register.activate', 'uses' => 'Odeva\Masterpoint\Controller\Site\Auth@getActivate'))
	->where('code', '[A-Za-z0-9]+');
/* Login */
Route::get('login', array('as' => 'auth.login', 'uses' => 'Odeva\Masterpoint\Controller\Site\Auth@getLogin'));
Route::post('login', 'Odeva\Masterpoint\Controller\Site\Auth@postLogin');
/* Logout */
Route::get('logout', array('as' => 'auth.logout', 'uses' => 'Odeva\Masterpoint\Controller\Site\Auth@getLogout'));
/* Reset Password */
Route::get('reset-password', array('as' => 'auth.login.reset-password', 'uses' => 'Odeva\Masterpoint\Controller\Site\Auth@getResetPassword'));
Route::post('reset-password', 'Odeva\Masterpoint\Controller\Site\Auth@postResetPassword');
Route::get('reset-password/success', array('as' => 'auth.login.reset-password.success', 'uses' => 'Odeva\Masterpoint\Controller\Site\Auth@getResetPasswordSuccess'));
Route::get('reset-password/change/{code}', array('as' => 'auth.login.reset-password.change', 'uses' => 'Odeva\Masterpoint\Controller\Site\Auth@getResetPasswordChange'))
	->where('code', '[A-Za-z0-9]+');
Route::post('reset-password/change/{code}', 'Odeva\Masterpoint\Controller\Site\Auth@postResetPasswordChange')
	->where('code', '[A-Za-z0-9]+');

/* User */
Route::group(array('prefix' => 'panel'), function() {
	Route::get('/', array('as' => 'panel', 'uses' => 'Odeva\Masterpoint\Controller\Panel\Panel@getIndex'));
	Route::post('perpage', array('as' => 'panel.perpage', 'uses' => 'Odeva\Masterpoint\Controller\Panel\Panel@postPerPage'));
	/* Account */
	Route::group(array('prefix' => 'account'), function() {
		Route::get('/', array('as' => 'panel.account', 'uses' => 'Odeva\Masterpoint\Controller\Panel\Account@getIndex'));
		Route::get('notifications', array('as' => 'panel.account.notifications', 'uses' => 'Odeva\Masterpoint\Controller\Panel\Account@getNotifications'));
		Route::get('details', array('as' => 'panel.account.details', 'uses' => 'Odeva\Masterpoint\Controller\Panel\Account@getDetails'));
		Route::post('details', 'Odeva\Masterpoint\Controller\Panel\Account@postDetails');
		/* Account Password */
		Route::group(array('prefix' => 'password'), function() {
			Route::get('/', array('as' => 'panel.account.password', 'uses' => 'Odeva\Masterpoint\Controller\Panel\Account@getPassword'));
			Route::post('/', 'Odeva\Masterpoint\Controller\Panel\Account@postPassword');
			Route::get('success', array('as' => 'panel.account.password.success', 'uses' => 'Odeva\Masterpoint\Controller\Panel\Account@getPasswordSuccess'));
		});
	});
	/* Club User */
	Route::group(array('prefix' => 'club'), function() {
		Route::get('/', array('as' => 'panel.club', 'uses' => 'Odeva\Masterpoint\Controller\Panel\Club\Club@getIndex'));
		/* Tournament */
		Route::group(array('prefix' => 'tournaments'), function() {
			Route::get('/', array('as' => 'panel.club.tournaments', 'uses' => 'Odeva\Masterpoint\Controller\Panel\Club\Tournament@getIndex'));
		});
		
	});
	/* Admin User */
	Route::group(array('prefix' => 'admin'), function() {
		Route::get('/', array('as' => 'panel.admin', 'uses' => 'Odeva\Masterpoint\Controller\Panel\Admin\Admin@getIndex'));
		/* Clubs */
		Route::model('club', 'Odeva\Masterpoint\Model\Club');
		Route::group(array('prefix' => 'clubs'), function() {
			Route::get('/', array('as' => 'panel.admin.clubs.index', 'uses' => 'Odeva\Masterpoint\Controller\Panel\Admin\Clubs@index'));
			Route::post('/', array('as' => 'panel.admin.clubs.store', 'uses' => 'Odeva\Masterpoint\Controller\Panel\Admin\Clubs@store'));
			Route::get('create', array('as' => 'panel.admin.clubs.create', 'uses' => 'Odeva\Masterpoint\Controller\Panel\Admin\Clubs@create'));
			Route::get('{club}/edit', array('as' => 'panel.admin.clubs.edit', 'uses' => 'Odeva\Masterpoint\Controller\Panel\Admin\Clubs@edit'));
			Route::put('{club}', array('as' => 'panel.admin.clubs.update', 'uses' => 'Odeva\Masterpoint\Controller\Panel\Admin\Clubs@update'));
			Route::delete('{club}', array('as' => 'panel.admin.clubs.destroy', 'uses' => 'Odeva\Masterpoint\Controller\Panel\Admin\Clubs@destroy'));
		});
		/* Users */
		Route::model('user', 'Odeva\Masterpoint\Model\User');
		Route::group(array('prefix' => 'users'), function() {
			Route::get('/', array('as' => 'panel.admin.users.index', 'uses' => 'Odeva\Masterpoint\Controller\Panel\Admin\Users@index'));
			Route::post('/', array('as' => 'panel.admin.users.store', 'uses' => 'Odeva\Masterpoint\Controller\Panel\Admin\Users@store'));
			Route::get('create', array('as' => 'panel.admin.users.create', 'uses' => 'Odeva\Masterpoint\Controller\Panel\Admin\Users@create'));
			Route::get('{user}/edit', array('as' => 'panel.admin.users.edit', 'uses' => 'Odeva\Masterpoint\Controller\Panel\Admin\Users@edit'));
			Route::put('{user}', array('as' => 'panel.admin.users.update', 'uses' => 'Odeva\Masterpoint\Controller\Panel\Admin\Users@update'));
			Route::delete('{user}', array('as' => 'panel.admin.users.destroy', 'uses' => 'Odeva\Masterpoint\Controller\Panel\Admin\Users@destroy'));
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
Route::get('/', array('as' => 'home', 'uses' => 'Odeva\Masterpoint\Controller\Site\Home@getIndex'));
Route::get('menu1', array('as' => 'menu1', 'uses' => 'Odeva\Masterpoint\Controller\Site\Home@getMenu1'));
Route::get('menu2', array('as' => 'menu2', 'uses' => 'Odeva\Masterpoint\Controller\Site\Home@getMenu2'));
Route::get('menu2a', array('as' => 'menu2a', 'uses' => 'Odeva\Masterpoint\Controller\Site\Home@getMenu2a'));
Route::get('menu2b', array('as' => 'menu2b', 'uses' => 'Odeva\Masterpoint\Controller\Site\Home@getMenu2b'));
Route::get('menu2c', array('as' => 'menu2c', 'uses' => 'Odeva\Masterpoint\Controller\Site\Home@getMenu2c'));
Route::get('menu3', array('as' => 'menu3', 'uses' => 'Odeva\Masterpoint\Controller\Site\Home@getMenu3'));
Route::get('menu3a', array('as' => 'menu3a', 'uses' => 'Odeva\Masterpoint\Controller\Site\Home@getMenu3a'));
Route::get('menu3b', array('as' => 'menu3b', 'uses' => 'Odeva\Masterpoint\Controller\Site\Home@getMenu3b'));
Route::get('menu4', array('as' => 'menu4', 'uses' => 'Odeva\Masterpoint\Controller\Site\Home@getMenu4'));

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

Route::controller('', 'Odeva\Masterpoint\Controller\Site\Home');
