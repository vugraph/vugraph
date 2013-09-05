<?php
Form::_focus('password');
echo Form::_open();
echo Form::_fieldsetOpen(trans('auth/reset-password.change_title'));
echo Form::_messages($errors->all());
echo Form::_row(
	Form::_label('password', trans('auth/reset-password.password')),
	Form::_input('password', 'password', null, array('required' => 'required', 'maxlength' => '30', 'pattern' => '.{6,30}')).
	Form::_help(trans('auth/reset-password.password_help'))
);
echo Form::_row(
	Form::_label('password_confirmation', trans('auth/reset-password.password_confirmation')),
	Form::_input('password', 'password_confirmation', null, array('required' => 'required', 'maxlength' => '30', 'pattern' => '.{6,30}'))
);
echo Form::_actions(
	array(
		Form::_cancel(),
		Form::_submit(trans('auth/reset-password.change'))
	)
);
echo Form::_fieldsetClose();
echo Form::_close();