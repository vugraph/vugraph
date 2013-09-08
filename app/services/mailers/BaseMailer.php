<?php namespace Tbfmp;

use Config;
use Mail;

abstract class BaseMailer {
	protected $to;
	protected $email;
	protected $subject;
	protected $view;
	protected $data = array();
	protected $options;
	
	public function __construct() {
		$this->data['sitename'] = trans('common.sitename');
		$this->data['siteurl'] = Config::get('app.url');
	}
	
	public function deliver() {
		return Mail::send($this->view, $this->data, function ($message) {
			$message->to($this->email, $this->to)->subject($this->subject);
			if (is_callable($this->options)) call_user_func($this->options, $message);
		});
	}
}