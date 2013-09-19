<?php
Form::_autofocus('first_name');
echo Form::_open();
echo Form::_fieldsetOpen(trans('auth/register.title'));
echo Form::_messages($errors->all());
echo Form::_row(
	Form::_label('first_name', trans('auth/register.labels.first_name')),
	Form::_input('text', 'first_name', null, array('required' => 'required', 'maxlength' => '30', 'pattern' => '.{1,30}')),
	'first_name'
);
echo Form::_row(
	Form::_label('last_name', trans('auth/register.labels.last_name')),
	Form::_input('text', 'last_name', null, array('required' => 'required', 'maxlength' => '30', 'pattern' => '.{2,30}')),
	'last_name'
);
echo Form::_row(
	Form::_label('email', trans('auth/register.labels.email')),
	Form::_input('email', 'email', null, array('required' => 'required', 'maxlength' => '100')).
	Form::_help(trans('auth/register.email_help')),
	'email'
);
echo Form::_row(
	Form::_label('password', trans('auth/register.labels.password')),
	Form::_input('password', 'password', null, array('required' => 'required', 'maxlength' => '30', 'pattern' => '.{6,30}')).
	Form::_help(trans('auth/register.password_help')),
	 'password');
echo Form::_row(
	Form::_label('password_confirmation', trans('auth/register.labels.password_confirmation')),
	Form::_input('password', 'password_confirmation', null, array('required' => 'required', 'maxlength' => '30', 'pattern' => '.{6,30}')),
	'password_confirmation'
);
echo Form::_actions(
	array(
		Form::_cancel(),
		Form::_submit(trans('auth/register.register'))
	)
);
echo Form::_fieldsetClose();
echo Form::_close();