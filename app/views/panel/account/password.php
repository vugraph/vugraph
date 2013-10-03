<?php
Form::_focus('current_password');
echo Form::_open();
echo Form::_fieldsetOpen(trans('panel/account/password.title'));
echo Form::_messages($errors->all());
echo Form::_row(
	Form::_label('current_password', trans('panel/account/password.labels.current_password')),
	Form::_input('password', 'current_password', null, array('required' => 'required', 'maxlength' => '30'))
);
echo Form::_row(
	Form::_label('new_password', trans('panel/account/password.labels.new_password')),
	Form::_input('password', 'new_password', null, array('required' => 'required', 'maxlength' => '30', 'pattern' => '.{6,30}')).
	Form::_help(trans('panel/account/password.new_password_help'))
);
echo Form::_row(
	Form::_label('new_password_confirmation', trans('panel/account/password.labels.new_password_confirmation')),
	Form::_input('password', 'new_password_confirmation', null, array('required' => 'required', 'maxlength' => '30', 'pattern' => '.{6,30}'))
);
echo Form::_actions(
	array(
		Form::_cancel(null, null, route('panel.account.notifications')),
		Form::_submit(trans('panel/account/password.change'))
	)
);
echo Form::_fieldsetClose();
echo Form::_close();