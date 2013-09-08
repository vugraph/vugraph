<?php //dd(@fields); dd(@$rows->getCollection()); ?>
<table class="table table-striped table-bordered table-hover table-condensed">
	<caption><strong><?= trans('user/admin/clubs.title') ?></strong> <a href="#" class="btn btn-mini btn-info" title="<?= trans('tables/common.addnew') ?>"><strong>&plus;</strong></a></caption>
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
				<a href="#" class="btn btn-mini btn-danger" title="<?= trans('tables/common.delete') ?>"><strong>&minus;</strong></a>
		</tr>
<?php	endforeach; ?>
	</tbody>
</table>
<?= $paginator->links() ?>