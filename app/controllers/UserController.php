<?php

/**
 * User Tasks like Login, Logout, Register...
 *
 * @author bshan
 */
class UserController extends BaseController {

	/**
	 * User Model
	 * @var User
	 */
	protected $user;
	
	/**
	 * Inject the models
	 * @param User $user
	 */
	public function __construct(User $user)
	{
		parent::__construct();
		$this->user = $user;
	}
	
	/**
	 * User home page
	 * @return View
	 */
	public function getIndex()
	{
		return 'Kullanıcı ana sayfa';
	}
	
	/**
	 * User login page
	 * @return View
	 */
	public function getLogin()
	{
		return 'Kullanıcı giriş';
	}
	
	/**
	 * User login
	 * @return Response
	 */
	public function postLogin()
	{
		return 'Kullanıcı giriş-post';
	}
	
	/**
	 * User logout page
	 * @return Response
	 */
	public function getLogout()
	{
		return 'Kullanıcı çıkış';
	}
	
	/**
	 * User registration page
	 * @return View
	 */
	public function getRegistration()
	{
		return 'Kullanıcı kayıt';
	}
	
	/**
	 * User registration
	 * @return Response
	 */
	public function postRegistration()
	{
		return 'Kullanıcı kayıt-post';
	}
}

?>
