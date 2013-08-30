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
Route::get('giris', 'AuthController@getGiris');
Route::post('giris', 'AuthController@postGiris');
Route::get('cikis', 'AuthController@getCikis');
Route::get('kayit', 'AuthController@getKayit');
Route::post('kayit', 'AuthController@postKayit');
Route::get('sifre-sifirla', 'AuthController@getSifreSifirla');

/* Site */
Route::controller('/', 'HomeController');
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

/* User */
Route::group(array('prefix' => 'kullanici'), function() {
	Route::get('/', 'UserController@getIndex');
	Route::get('hesap-bilgileri', 'UserController@getHesapBilgileri');
	Route::get('sifre-degistir', 'UserController@getSifreDegistir');
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