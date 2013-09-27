<div class="page-header">
	<h2 class="pull-left"><?= trans('panel/admin/clubs.title') ?></h2>
	<div class="pull-right toolbox">
		<!--a href="javascript:void(0)" id="filterbutton" class="btn btn-small btn-info dropdown-toggle" data-toggle="dropdown"><i class="icon-filter icon-white"></i> <?= trans('tables/common.filter') ?></a-->
		&nbsp;
		<div class="btn-group">
			<button class="btn btn-small btn-info dropdown-toggle" data-toggle="dropdown"><?= trans('tables/common.per_page') ?> <span class="caret"></span></button>
<?php		echo HTML::_perPage(); ?>
		</div>
		&nbsp;
		<a href="<?= route('panel.admin.clubs.create') ?>" class="btn btn-small btn-success"><i class="icon-plus-sign icon-white"></i> <?= trans('tables/common.add_new') ?></a>
	</div>
</div>
<div id="filter" class="alert alert-info" style="clear: both;">
<?= ''//Form::open(array('id' => 'filter', 'method' => 'get', 'class' => 'form-horizontal', 'style' => 'clear: both')) ?>
<?=	''//Form::_fieldsetOpen(trans('tables/common.filter')); ?>
	<div class="pull-left">
<?=		Form::label('city', trans('panel/admin/clubs.filter_by_city')).
		Form::select('city', $cities, Input::get('city')) ?>
	</div>
	<div class="pull-right">
<?=		Form::label('search', 'Arama yap').
		Form::input('text', 'search') ?>
	</div>
	<div style="clear: both"></div>
<?= ''//Form::close() ?>
</div>
<?= Form::open(array('id' => 'data-table', 'method' => 'delete', 'data-delete-dialog' => trans('tables/common.delete_dialog'))) ?>
<?= HTML::_messages($errors->all()) ?>
<?= HTML::_dataTable($fields, $paginator->getItems(), $actions); ?>
<?php /*
<table class="table table-striped table-bordered table-hover table-condensed">
	<thead>
		<tr>
<?php		//$orderByLinks = $indexPage->getOrderByLinks(); ?>
<?php		foreach($clubs->getFields() as $field): ?>
			<th><?= isset($orderByLinks[$field]) ? '<a href="'.$orderByLinks[$field]->link.'" style="display: block">'.trans('tables/clubs.fields.'.$field).(isset($orderByLinks[$field]->image) ? '<span class="pull-right">'.$orderByLinks[$field]->image.'</span>' : '').'</a>' : trans('tables/clubs.fields.'.$field) ?></th>
<?php		endforeach; ?>
			<th><?= trans('tables/common.action') ?></th>
		</tr>
	</thead>
	<tbody>
<?php	foreach ($clubs->getPaginator()->getItems() as $item): ?>
		<tr>
<?php		foreach ($clubs->getFields() as $field): ?>
			<td><?= $item->$field ?></td>
<?php		endforeach; ?>
			<td>
				<button data-action="<?= route('panel.admin.clubs.destroy', $item->id) ?>" class="destroy btn btn-mini btn-danger"><?= trans('tables/common.delete') ?></button>
			</td>
		</tr>
<?php	endforeach; ?>
	</tbody>
</table>
 * 
 */ ?>
<?= Form::close() ?>
<?= $paginator->links() ?>