<?php
echo HTML::_header(
	trans('panel/admin/'.$table.'.title'),
	HTML::_toolbox(
		array(
			HTML::_perPage($table, $paginator->getPerPage()),
			HTML::_addNew(route('panel.admin.'.$table.'.create'))
		)
	)
);
echo HTML::_filters(
	array(Form::_filter('city', $cities, trans('panel/admin/'.$table.'.filter_by_city'))),
	array(Form::_search('search'))
);
echo Form::open(array('id' => 'data-table', 'method' => 'delete', 'data-delete-dialog' => trans('tables/common.delete_dialog')));
echo HTML::_messages($errors->all());
echo HTML::_dataTable($fields, $paginator->getItems(), $actions);
echo Form::close();
echo $paginator->links();