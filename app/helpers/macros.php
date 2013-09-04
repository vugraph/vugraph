<?php
Form::macro('_open', function(array $options = array()) {
	if (!isset($options['class'])) $options['class'] = 'form-horizontal well';
	return Form::open($options)."\n";
});
Form::macro('_close', function() {
	return Form::close()."\n";
});
Form::macro('_fieldsetOpen', function($legend = '') {
	return '<fieldset>'."\n".(empty($legend) ? '' : Form::_legend($legend));
});
Form::macro('_fieldsetClose', function() {
	return '</fieldset>'."\n";
});
Form::macro('_legend', function($legend) {
	return '<legend style="padding-left: 180px">'.$legend.'</legend>'."\n";
});
Form::macro('_messages', function($errors) {
	$result = HTML::_messages($errors);
	if (!empty($result)) return Form::_row('', $result);
});
HTML::macro('_messages', function($errors) {
	$result = '';
	if (!empty($errors)) {
		$result .= '<ul class="unstyled">';
		foreach ($errors as $error) {
			$result .= '<li class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$error.'</li>';
		}
		$result .= '</ul>'."\n";
	}
	if (Session::has('message-error')) $result .= '<p class="alert alert-error">'.Session::get('message-error').'</p>'."\n";
	if (Session::has('message-warning')) $result .= '<p class="alert">'.Session::get('message-warning').'</p>'."\n";
	if (Session::has('message-info')) $result .= '<p class="alert alert-info">'.Session::get('message-info').'</p>'."\n";
	if (Session::has('message-success')) $result .= '<p class="alert alert-success">'.Session::get('message-success').'</p>'."\n";	
	return $result;
});
Form::macro('_row', function($left, $right) {
	return '<div class="control-group">'."\n".$left."\n".'<div class="controls">'."\n".$right."\n".'</div>'."\n".'</div>'."\n";
});
Form::macro('_label', function($name, $value = null, $options = array()) {
	if (!isset($options['class'])) $options['class'] = 'control-label';
	return Form::label($name, $value, $options);
});
Form::macro('_input', function($type, $name, $value = null, $options = array()) {
//	if (is_null($value)) $value = Input::old($name);
	return Form::input($type, $name, $value, $options);
});
Form::macro('_help', function($text) {
	return '<span class="help-inline">'.$text.'</span>';
});
Form::macro('_actions', function($elements = array()) {
	return '<div class="form-actions">'.implode($elements, '&nbsp;').'</div>'."\n";
});
Form::macro('_cancel', function($link = null, $title = null) {
	if (is_null($link)) $link = URL::previous();
	if ($link == URL::full()) $link = URL::to('/');
	if (is_null($title)) $title = trans('common.cancel');
	return '<a href="'.$link.'" class="btn">'.$title.'</a>';
});
Form::macro('_submit', function($value = null, $options = array()) {
	if (!isset($options['class'])) $options['class'] = 'btn btn-primary';
	return Form::submit($value, $options);
});