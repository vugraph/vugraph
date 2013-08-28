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
	public function getLogin()
	{
		return 'Kullanıcı giriş';
	}
	
	/**
	 * Login
	 * @return Response
	 */
	public function postLogin()
	{
		return 'Kullanıcı giriş-post';
	}
	
	/**
	 * Logout page
	 * @return Response
	 */
	public function getLogout()
	{
		return 'Kullanıcı çıkış';
	}
	
	/**
	 * Registration page
	 * @return View
	 */
	public function getRegistration()
	{
		return 'Kullanıcı kayıt';
	}
	
	/**
	 * Registration
	 * @return Response
	 */
	public function postRegistration()
	{
		return 'Kullanıcı kayıt-post';
	}
}