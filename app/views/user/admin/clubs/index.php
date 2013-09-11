<?php
?>
	<!--table id="blogs" class="table table-bordered table-hover">
		<thead>
			<tr>
				<th class="span4">{{{ Lang::get('admin/blogs/table.title') }}}</th>
				<th class="span2">{{{ Lang::get('admin/blogs/table.comments') }}}</th>
				<th class="span2">{{{ Lang::get('admin/blogs/table.created_at') }}}</th>
				<th class="span2">{{{ Lang::get('table.actions') }}}</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table-->
<?= Form::open(array('id' => 'destroy', 'method' => 'delete', 'data-delete-dialog' => trans('tables/common.delete_dialog'))) ?>

	<div class="page-header">
		<h2 class="pull-left"><?= trans('user/admin/clubs.title') ?></h2>
<?php		if (isset($toolbox)): ?>
			<ul class="unstyled pull-right toolbox">
<?php			foreach ($toolbox as $item): ?>
				<li><a href="<?= route($item->route) ?>" class="btn btn-small btn-info"><?= $item->content ?></a></li>
<?php			endforeach; ?>
			</ul>
<?php		endif; ?>
	</div>
	<?= HTML::_messages($errors->all()) ?>
<table class="table table-striped table-bordered table-hover table-condensed">
	<thead>
		<tr>
<?php		foreach($fields as $field): ?>
			<th><?= trans('tables/'.$table.'.'.$field) ?></th>
<?php		endforeach; ?>
			<th><?= trans('tables/common.action') ?></th>
		</tr>
	</thead>
	<tbody>
<?php	foreach ($paginator->getItems() as $item): ?>
		<tr>
<?php		foreach ($fields as $field): ?>
			<td><?= $item->$field ?></td>
<?php		endforeach; ?>
			<td>
				<button
					data-action="<?= route('user.admin.clubs.destroy', $item->id) ?>" class="destroy btn btn-mini btn-danger"><?= trans('tables/common.delete') ?></button>
			</td>
		</tr>
<?php	endforeach; ?>
	</tbody>
</table>
<?= Form::close() ?>
<?= $paginator->links() ?>