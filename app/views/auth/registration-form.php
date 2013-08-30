<?php

/*
echo formOpen().
Notification::showAll().
formFieldsetOpen('Siteye Kayıt').
formRow(
	formLabel('first_name', 'Adınız'),
	formInput('text', 'first_name', null, array('required' => 'required', 'maxlength' => '30', 'pattern' => '.{2,30}'), true)
).
formRow(
	formLabel('last_name', 'Soyadınız'),
	formInput('text', 'last_name', null, array('required' => 'required', 'maxlength' => '30', 'pattern' => '.{2,30}'))
).
formRow(
	formLabel('email', 'E-Posta Adresiniz'),
	formInput('email', 'email', null, array('required' => 'required', 'maxlength' => '100'))
	.formHelp('Adresinize aktivasyon e-postası gelecektir')
).
formRow(
	formLabel('password', 'Şifre belirleyiniz'),
	formInput('password', 'password', null, array('required' => 'required', 'pattern' => '.{6,30}'))
	.formHelp('En az 6 en çok 30 karakter')
).
formRow(
	formLabel('password_confirm', 'Şifre (tekrar)'),
	formInput('password', 'password_confirm', null, array('required' => 'required', 'pattern' => '.{6,30}'))
).
formActions(array(
	formCancel(),
	formSubmit('Kaydol')
)).
formFieldsetClose().
formClose();
*/