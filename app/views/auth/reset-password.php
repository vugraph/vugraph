<?php

Form::_focus('email');
echo Form::_open();
echo Form::_fieldsetOpen(trans('auth/reset-password.title'));
echo Form::_messages($errors->all());
echo Form::_row(
	Form::_label('email', trans('auth/reset-password.email')),
	Form::_input('email', 'email', null, array('required' => 'required', 'maxlength' => '100')).
	Form::_help(trans('auth/reset-password.email_help'))
);
echo Form::_actions(
	array(
		Form::_cancel(),
		Form::_submit(trans('auth/reset-password.submit'))
	)
);
echo Form::_fieldsetClose();
echo Form::_close();