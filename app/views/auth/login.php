<?php
if (Input::old('email')) Form::_focus('password');
else Form::_focus('email');
echo Form::_open();
echo Form::_fieldsetOpen(trans('auth/login.title'));
echo Form::_messages($errors->all());
echo Form::_row(
	Form::_label('email', trans('auth/login.email')),
	Form::_input('email', 'email', null, array('required' => 'required', 'maxlength' => '100'))
);
echo Form::_row(
	Form::_label('password', trans('auth/login.password')),
	Form::_input('password', 'password', null, array('required' => 'required', 'maxlength' => '30'))
);
echo Form::_actions(
	array(
		Form::_cancel(),
		Form::_submit(trans('auth/login.login'))
	)
);
echo Form::_row(
	'',
	link_to('reset-password', trans('auth/login.forgot_password'))
);
echo Form::_fieldsetClose();
echo Form::_close();