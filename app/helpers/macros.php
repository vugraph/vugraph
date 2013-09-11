<?php
Form::macro('_open', function(array $options = array()) {
	if (!isset($options['class'])) $options['class'] = 'form-horizontal well';
	return Form::open($options)."\n";
});
Form::macro('_model', function($model, array $options = array()) {
	if (!isset($options['class'])) $options['class'] = 'form-horizontal well';
	return Form::model($model, $options);
});
Form::macro('_focus', function($field) {
	View::share('autofocus', $field);
});
Form::macro('_autofocus', function($field = null) {
	if (Session::has('errors')) {
		$errors = Session::get('errors');
		if ($errors->any()) {
			$messages = $errors->getMessages();
			reset($messages);
			Form::_focus(key($messages));
		}
	} elseif(!empty($field)) Form::_focus($field);
});
Form::macro('_close', function() {
	return /* print_r(View::getShared(), true). */ Form::close()."\n";
});
Form::macro('_fieldsetOpen', function($legend = '') {
	return '<fieldset>'."\n".(empty($legend) ? '' : Form::_legend($legend));
});
Form::macro('_fieldsetClose', function() {
	return '</fieldset>'."\n";
});
Form::macro('_legend', function($legend) {
	return '<legend><span style="padding-left: 180px">'.$legend.'</span></legend>'."\n";
});
Form::macro('_messages', function($errors) {
	$result = HTML::_messages($errors);
	if (!empty($result)) return Form::_row('', '<div style="float: left">'."\n".$result.'</div>'."\n");
});
HTML::macro('_messages', function($errors = null) {
	$result = '';
	if (Session::has('message-success')) $result .= '<p class="alert alert-success">'.Session::get('message-success').'</p>'."\n";
	if (Session::has('message-info')) $result .= '<p class="alert alert-info">'.Session::get('message-info').'</p>'."\n";
	if (Session::has('message-warning')) $result .= '<p class="alert">'.Session::get('message-warning').'</p>'."\n";
	if (Session::has('message-error')) $result .= '<p class="alert alert-error">'.Session::get('message-error').'</p>'."\n";
	if (!empty($errors)) {
		$result .= '<ul class="unstyled">';
		foreach ($errors as $error) {
			$result .= '<li class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$error.'</li>';
		}
		$result .= '</ul>'."\n";
	}
	return '<div id="messages">'."\n".$result.'</div>'."\n";
});
Form::macro('_row', function($left, $right, $fields = null) {
	$state = '';
	if (!empty($fields) && Session::has('errors')) {
		$errors = Session::get('errors');
		foreach((array) $fields as $field) if ($errors->has($field)) $state = ' error';
	}
	return '<div class="control-group'.$state.'">'."\n".$left."\n".'<div class="controls">'."\n".$right."\n".'</div>'."\n".'</div>'."\n";
});
Form::macro('_label', function($name, $value = null, $options = array()) {
	if (!isset($options['class'])) $options['class'] = 'control-label';
	return Form::label($name, $value, $options);
});
Form::macro('_input', function($type, $name, $value = null, $options = array()) {
	if (Form::_hasFocus($name)) $options['autofocus'] = 'autofocus';
	if (Form::_hasError($name)) $options['oninput'] = '$(this).parents(\'div.control-group\').removeClass(\'error\')';
	if (!empty($shared) && $shared == $name) $options['autofocus'] = 'autofocus';
	return Form::input($type, $name, $value, $options);
});
Form::macro('_hasError', function($field) {
	if (Session::has('errors')) {
		$errors = Session::get('errors');
		if ($errors->has($field)) return true;
	}
	return false;
});
Form::macro('_hasFocus', function($field) {
	$shared = View::getShared();
	if (isset($shared['autofocus']) && $shared['autofocus'] == $field) return true;
	return false;
});
Form::macro('_help', function($text) {
	return '<span class="help-inline">'.$text.'</span>';
});
Form::macro('_actions', function($elements = array()) {
	return '<div class="form-actions">'.implode($elements, '&nbsp;').'</div>'."\n";
});
Form::macro('_cancel', function($title = null, $link = null, $failDefault = 'home') {
	if (is_null($link)) $link = URL::previous();
	if ($link == URL::full()) $link = route($failDefault);
	if (is_null($title)) $title = trans('common.cancel');
	return '<a href="'.$link.'" class="btn">'.$title.'</a>';
});
Form::macro('_userCancel', function($title = null, $link = null) {
	return Form::_cancel($title, $link, 'user.account.notifications');
});
Form::macro('_submit', function($value = null, $options = array()) {
	if (!isset($options['class'])) $options['class'] = 'btn btn-primary';
	return Form::submit($value, $options);
});