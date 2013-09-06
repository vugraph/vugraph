<?php
Form::_focus('current_password');
echo Form::_model($user);
echo Form::_fieldsetOpen(trans('user/change-password.title'));
echo Form::_messages($errors->all());
echo Form::_row(
	Form::_label('current_password', trans('user/change-password.current_password')),
	Form::_input('password', 'current_password', null, array('required' => 'required', 'maxlength' => '30'))
);
echo Form::_row(
	Form::_label('password', trans('user/change-password.new_password')),
	Form::_input('password', 'password', null, array('required' => 'required', 'maxlength' => '30', 'pattern' => '.{6,30}')).
	Form::_help(trans('user/change-password.new_password_help'))
);
echo Form::_row(
	Form::_label('password_confirmation', trans('user/change-password.new_password_confirmation')),
	Form::_input('password', 'password_confirmation', null, array('required' => 'required', 'maxlength' => '30', 'pattern' => '.{6,30}'))
);
echo Form::_actions(
	array(
		Form::_userCancel(),
		Form::_submit(trans('user/change-password.change'))
	)
);
echo Form::_fieldsetClose();
echo Form::_close();