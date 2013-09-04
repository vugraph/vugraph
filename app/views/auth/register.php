<?php
echo Form::_open();
echo Form::_fieldsetOpen(trans('auth/register.title'));
echo Form::_messages($errors->all());
echo Form::_row(Form::_label('first_name', trans('auth/register.first_name')),
	 Form::_input('text', 'first_name', null, array('required' => 'required', 'maxlength' => '30', 'pattern' => '.{2,30}')));
echo Form::_row(Form::_label('last_name', trans('auth/register.last_name')),
	 Form::_input('text', 'last_name', null, array('required' => 'required', 'maxlength' => '30', 'pattern' => '.{2,30}')));
echo Form::_row(Form::_label('email', trans('auth/register.email')),
	 Form::_input('email', 'email', null, array('required' => 'required', 'maxlength' => '100')).
	 Form::_help(trans('auth/register.email_help')));
echo Form::_row(Form::_label('password', trans('auth/register.password')),
	 Form::_input('password', 'password', null, array('required' => 'required', 'maxlength' => '30', 'pattern' => '.{6,30}')).
	 Form::_help(trans('auth/register.password_help')));
echo Form::_row(Form::_label('password_confirmation', trans('auth/register.password_confirmation')),
	 Form::_input('password', 'password_confirmation', null, array('required' => 'required', 'maxlength' => '30', 'pattern' => '.{6,30}')));
echo Form::_actions(array(
	 Form::_cancel(),
	 Form::_submit(trans('auth/register.register'))
));
echo Form::_fieldsetClose();
echo Form::_close();