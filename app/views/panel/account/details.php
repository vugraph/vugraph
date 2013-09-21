<?php
echo Form::_model($user);
echo Form::_fieldsetOpen(trans('panel/account/details.title'));
echo Form::_messages($errors->all());
echo Form::_row(
	Form::_label('first_name', trans('panel/account/details.labels.first_name')),
	Form::_input('text', 'first_name', null, array('required' => 'required', 'maxlength' => '30', 'pattern' => '.{2,30}'))
);
echo Form::_row(
	Form::_label('last_name', trans('panel/account/details.labels.last_name')),
	Form::_input('text', 'last_name', null, array('required' => 'required', 'maxlength' => '30', 'pattern' => '.{2,30}'))
);
echo Form::_row(
	Form::_label('email', trans('panel/account/details.labels.email')),
	Form::_input('email', 'email', null, array('required' => 'required', 'maxlength' => '100', 'disabled' => 'disabled'))
);
echo Form::_actions(
	array(
		Form::_userCancel(),
		Form::_submit(trans('form.update'))
	)
);
echo Form::_fieldsetClose();
echo Form::_close();