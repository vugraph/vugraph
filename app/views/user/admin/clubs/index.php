<?= Form::open(array('id' => 'destroy', 'method' => 'delete', 'data-delete-dialog' => trans('tables/common.delete_dialog'))) ?>

	<div class="page-header">
		<h2 class="pull-left"><?= trans('user/admin/clubs.title') ?></h2>
		<div class="pull-right toolbox">
			<div class="btn-group">
				<a class="btn btn-small btn-info btn-dropdown-toggle" data-toggle="dropdown" href="#"><?= trans('filter_by_city') ?><span class="caret"></span></a>
				<ul id="filterbycity" class="dropdown-menu">
				</ul>
			</div>
			&nbsp;
			<div class="btn-group">
				<a class="btn btn-small btn-inverse btn-dropdown-toggle" data-toggle="dropdown" href="#"><?= trans('tables/common.per_page') ?><span class="caret"></span></a>
				<ul id="perpage" class="dropdown-menu">
<?php				foreach($perPageOptions as $perPage): ?>
					<li<?= $perPage->selected ? ' class="active"' : '' ?>><a href="<?= $perPage->link ?>"><?= $perPage->value ?></a></li>
<?php				endforeach; ?>
				</ul>
			</div>
			&nbsp;
			<a href="<?= route('user.admin.clubs.create') ?>" class="btn btn-small btn-success"><i class="icon-plus-sign icon-white"></i> <?= trans('tables/common.add_new') ?></a>
		</div>
	</div>
	<?= HTML::_messages($errors->all()) ?>
<table class="table table-striped table-bordered table-hover table-condensed">
	<thead>
		<tr>
<?php		foreach($fields as $field): ?>
			<th><?= isset($orderBy[$field]) ? '<a href="'.$orderBy[$field]->link.'" style="display: block">'.trans('tables/clubs.'.$field).(isset($orderBy[$field]->image) ? '<span class="pull-right">'.$orderBy[$field]->image.'</span>' : '').'</a>' : trans('tables/clubs.'.$field) ?></th>
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
				<button data-action="<?= route('user.admin.clubs.destroy', $item->id) ?>" class="destroy btn btn-mini btn-danger"><?= trans('tables/common.delete') ?></button>
			</td>
		</tr>
<?php	endforeach; ?>
	</tbody>
</table>
<?= Form::close() ?>
<?= $paginator->links() ?>