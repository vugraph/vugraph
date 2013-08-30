<?php

/**
 * Authentication Tasks like Login, Logout, Register...
 *
 * @author bshan
 */
class AuthController extends BaseController {

	/**
	 * Login page
	 * @return View
	 */
	public function getGiris()
	{
		$this->title = $this->heading = 'Kullanıcı Girişi';
		$this->sidebar = null;
		$this->showPage('auth.login-form');
	}
	
	/**
	 * Login
	 * @return Response
	 */
	public function postGiris()
	{
		return 'Kullanıcı giriş-post';
	}
	
	/**
	 * Logout page
	 * @return Response
	 */
	public function getCikis()
	{
		return 'Kullanıcı çıkış';
	}
	
	/**
	 * Registration page
	 * @return View
	 */
	public function getKayit()
	{
		$this->title = $this->heading = 'Kayıt';
		$this->showPage('auth.registration-form');
	}
	
	/**
	 * Registration
	 * @return Response
	 */
	public function postKayit()
	{
		return 'Kullanıcı kayıt-post';
	}
	
	public function getSifreSifirla()
	{
		return 'Şifre sıfırlama';
	}
}