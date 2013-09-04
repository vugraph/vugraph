<?php

class UserMailer extends MyMailer {
	protected $user;
	public function __construct($user) {
		parent::__construct();
		if (!is_object($user)) App::abort(500, 'Please pass a valid user object.');
		$this->user = $user;
		$this->to = $this->data['name'] = trim($user->first_name.' '.$user->last_name);
		$this->email = $user->email;
	}
	
	public function activate($code) {
		$this->subject = trans('auth/register.mail_subject');
		$this->view = 'emails.auth.activate';
		$this->data['link'] = route('auth.register.activate', array('code' => $code));
		return $this;
	}
	
	public function resetPassword($code) {
		$this->subject = 'Şifre Sıfırlama';
		$this->view = 'emails.auth.reset-password';
		$this->data['link'] = route('auth.reset-password-change', array('id' => $this->user->id, 'code' => $code));
		return $this;
	}
}