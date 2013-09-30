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
HTML::macro('_header', function($header, $extras = '') {
	return '<div class="page-header">'."\n".
		'<h2 class="pull-left">'.$header.'</h2>'."\n".
		(empty($extras) ? '' : $extras."\n").
		'</div>'."\n";
});
HTML::macro('_toolbox', function($tools) {
	$html = '<div class="pull-right toolbox">'."\n";
	foreach ($tools as $tool) $html .= '&nbsp;'.$tool."\n";
	$html .= '</div>'."\n";
	return $html;
});
HTML::macro('_perPage', function($table, $default) {
	$html = Form::open(array('id' => 'form-perpage', 'route' => 'panel.perpage'));
	$html .= Form::input('hidden', 'table', $table);
	$html .= Form::input('hidden', 'perpage', $default, array('id' => 'input-perpage'));
	$html .= '<div class="btn-group">'."\n";
	$html .= '<button class="btn btn-small btn-info dropdown-toggle" data-toggle="dropdown">'.trans('tables/common.per_page').' <span class="caret"></span></button>'."\n";
	$html .= '<ul id="perpage" class="dropdown-menu">'."\n";
	$cnt = 0;
	foreach (array('10', '20', '50', '100') as $option) {
		$html .= '<li'.($default == $option ? ' class="active"' : '').'>';
		$html .= '<a href="javascript:setPerPage('.$option.')">'.$option.'</a>';
		$html .= '</li>'."\n";
	}
	$html .= '</ul>'."\n";
	$html .= '</div>'."\n";
	$html .= Form::close();
	return $html;
});
HTML::macro('_addNew', function($url, $title = null) {
	if (empty($title)) $title = '<i class="icon-plus-sign icon-white"></i> '.trans('tables/common.add_new');
	return '<a href="'.$url.'" class="btn btn-small btn-success">'.$title.'</a>';
});
HTML::macro('_filters', function($left, $right) {
	$html = Form::open(array('id' => 'form-filters', 'class' => 'alert alert-info', 'method' => 'get'));
	if ($orderBy = Request::query('orderby')) $html .= Form::input('hidden', 'orderby', $orderBy);
	if ($orderDir = Request::query('orderdir')) $html .= Form::input('hidden', 'orderdir', $orderDir);
	$html .= '<div class="pull-left">'."\n";
	foreach ($left as $item) $html .= $item."\n";
	$html .= '</div>'."\n";
	$html .= '<div class="pull-right">'."\n";
	foreach ($right as $item) $html .= $item."\n";
	$html .= '</div>'."\n";
	$html .= '<div style="clear: both"></div>'."\n";
	$html .= Form::close();
	return $html;
});
Form::macro('_filter', function($name, $values, $label) {
	return Form::label($name, $label).Form::select($name, $values, Request::query($name));
});
Form::macro('_search', function($q) {
	$value = Request::query($q);
	if (!empty($value)) $html = '<button id="search-reset" class="pull-right btn btn-mini btn-info">'.trans('tables/common.clear').'</button>';
	else $html = '';
	$html .= Form::label($q, 'Arama yap');
	$html .= Form::input('search', $q, $value, array('class' => 'search-query'));
	$html .= "\n";
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
	foreach ($queryString as $key => $value) {
		if (is_null($value)) unset($params[$key]);
		else $params[$key] = $value;
	}
	$q = http_build_query($params, '', '&amp;');
	if (!empty($q)) $url .= '?'.$q;
	return $url;
});