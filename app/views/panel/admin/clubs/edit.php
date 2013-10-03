<?php

Form::_autofocus('city_id');
if (isset($club)) {
	$mode = 'edit';
	$submit = 'update';
	echo Form::_model($club, array('method' => 'put', 'route' => array('panel.admin.clubs.update', $club->id)));
} else {
	$mode = 'create';
	$submit = 'add';
	echo Form::_open(array('route' => 'panel.admin.clubs.store'));
}
echo Form::_fieldsetOpen(trans('panel/admin/clubs.'.$mode.'.title'));
echo Form::_messages($errors->all());
echo Form::_row(
	Form::_label('city_id', trans('tables/clubs.fields.city_name')),
	Form::_select('city_id', $cities, null, array('required' => 'required')),
	'city_id'
);
echo Form::_row(
	Form::_label('name', trans('tables/clubs.fields.name')),
	Form::_input('text', 'name', null, array('required' => 'required', 'maxlength' => '60', 'pattern' => '.{2,60}')),
	'name'
);
echo Form::_row(
	Form::_label('shortname', trans('tables/clubs.fields.shortname')),
	Form::_input('text', 'shortname', null, array('maxlength' => '15')),
	'shortname'
);
echo Form::_row(
	Form::_label('address', trans('tables/clubs.fields.address')),
	Form::_input('text', 'address', null, array('maxlength' => '240')),
	'address'
);
echo Form::_row(
	Form::_label('phone', trans('tables/clubs.fields.phone')),
	Form::_input('text', 'phone', null, array('maxlength' => '60')),
	'phone'
);
echo Form::_row(
	Form::_label('fax', trans('tables/clubs.fields.fax')),
	Form::_input('text', 'fax', null, array('maxlength' => '60')),
	'fax'
);
echo Form::_row(
	Form::_label('email', trans('tables/clubs.fields.email')),
	Form::_input('email', 'email', null, array('maxlength' => '120')),
	'email'
);
echo Form::_row(
	Form::_label('website', trans('tables/clubs.fields.website')),
	Form::_input('url', 'website', null, array('maxlength' => '120')),
	'website'
);
echo Form::_actions(
	array(
		Form::_cancel(null, null, Session::get('prefs.clubs.'.$mode.'.previous', route('panel.admin.clubs.index'))),
		Form::_submit(trans('tables/common.'.$submit))
	)
);
echo Form::_fieldsetClose();
echo Form::_close();