<?php

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
HTML::macro('_back', function($link = null, $failDefault = 'home') {
	if (is_null($link)) $link = URL::previous();
	if ($link == URL::current()) $link = route($failDefault);
	return '<a href="'.$link.'" class="btn">'.trans('tables/common.back').'</a>';
});
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
	$shared = View::getShared();
	if (!empty($shared) && $shared === $name) $options['autofocus'] = 'autofocus';
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
	if ($link == URL::current()) $link = route($failDefault);
	if (is_null($title)) $title = trans('form.cancel');
	return '<a href="'.$link.'" class="btn">'.$title.'</a>';
});
Form::macro('_userCancel', function($title = null, $link = null) {
	return Form::_cancel($title, $link, 'panel.account.notifications');
});
Form::macro('_submit', function($value = null, $options = array()) {
	if (!isset($options['class'])) $options['class'] = 'btn btn-primary';
	return Form::submit($value, $options);
});
HTML::macro('_perPage', function() {
	$perPage = Session::get('perPage', '10');
	$html = '<ul id="perpage" class="dropdown-menu">'."\n";
	foreach (array('10', '20', '50', '100') as $option) {
		$html .= '<li'.($perPage == $option ? ' class="active"' : '').'><a href="'.HTML::_makeSelfLink(array('perpage' => $option, 'page' => null)).'">'.$option.'</a></li>'."\n";
	}
	$html .= '</ul>'."\n";
	return $html;
});
HTML::macro('_dataTable', function($fields, $data, $actions) {
	$html = '';
	if (count($data) == 0) return $html;
	$html .= '<table id="datatable" class="table table-striped table-bordered table-hover table-condensed">'."\n";
	$html .= '<thead>'."\n";
	$html .= '<tr>'."\n";
	$params = Request::query();
	foreach ($fields as $field => $fieldTrans) {
		$html .= '<td>';
		$html .= '<a href="'.HTML::_makeSelfLink(
			array(
				'orderby' => $field,
				'orderdir' => isset($params['orderby']) && $params['orderby'] == $field
					? !isset($params['orderdir']) || $params['orderdir'] != 'desc' ? 'desc'	: 'asc'
					: null
			)
		).'">';
		$html .= $fieldTrans;
		if (!isset($params['orderby'])) $params['orderby'] = 'id';
		if (!isset($params['orderdir'])) $params['orderdir'] = 'asc';
		if ($params['orderby'] == $field) $html .= '<span class="pull-right"><i class="icon-chevron-'.($params['orderdir'] == 'desc' ? 'up' : 'down').'"></i></span>';
		$html .= '</a>';
		$html .= '</td>'."\n";
	}
	if (!empty($actions)) $html .= '<td>'.trans('tables/common.action').'</td>'."\n";
	$html .= '</tr>'."\n";
	$html .= '</thead>'."\n";
	$html .= '<tbody>'."\n";
	foreach ($data as $item) {
		$html .= '<tr>'."\n";
		foreach ($fields as $field => $fieldTrans) {
			$html .= '<td>'.$item->$field.'</td>'."\n";
		}
		if (!empty($actions)) {
			$html .= '<td>';
			foreach ($actions as $key => $action) {
				if ($key == 'edit') {
					$html .= '<a href="'.route($action, $item->id).'" class="edit btn btn-mini">'.trans('tables/common.edit').'</a>&nbsp;';
				} elseif ($key == 'delete') {
					$html .= '<button data-action="'.route($action, $item->id).'" class="delete btn btn-mini btn-danger">'.trans('tables/common.delete').'</button>&nbsp;';
				}
			}
			$html .= '</td>'."\n";
		}
		$html .= '</tr>'."\n";
	}
	$html .= '</tbody>'."\n";
	$html .= '</table>'."\n";
	return $html;
});
/* Create a url with params set as query string variables */
HTML::macro('_makeSelfLink', function(array $queryString) {
	$url = Request::url();
	$params = Request::query();
	unset($params['perpage']);
	foreach ($queryString as $key => $value) {
		if (is_null($value)) unset($params[$key]);
		else $params[$key] = $value;
	}
	$q = http_build_query($params, '', '&amp;');
	if (!empty($q)) $url .= '?'.$q;
	return $url;
});