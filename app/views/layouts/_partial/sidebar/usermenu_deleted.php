<div class="well" style="padding: 20px 0; margin-top: 8px">
	<ul class="nav nav-list">
<?php	$cnt = 0; ?>
<?php	foreach ($usermenu as $header => $menu): ?>
<?php	if (!is_int($header)): ?>
		<li class="nav-header"><?= trans('usermenu.'.$header) ?></li>
<?php	endif; ?>
<?php	foreach ($menu as $item): ?>
		<li<?= $item->selected ? ' class="active"' : '' ?>>
			<a href="<?= route($item->route) ?>"><?= empty($item->icon) ? '' : '<i class="'.$item->icon.'"></i> ' ?><?= trans('usermenu.'.$item->route) ?></a>
<?php		if (empty($item->items)): ?>
			<ul>
<?php		foreach($item->items as $item2): ?>
				<li<?= $item2->selected ? ' class="active"' : '' ?>>
					<a href="<?= route($item2->route) ?>"><?= empty($item2->icon) ? '' : '<i class="'.$item2->icon.'"></i> ' ?><?= trans('usermenu.'.$item2->route) ?></a>
				</li>
<?php		endforeach; ?>
			</ul>
<?php		endif; ?>
		</li>
<?php	endforeach; ?>
<?php	if (++$cnt < count($usermenu)): ?>
		<li class="divider"></li>
<?php	endif; ?>
<?php	endforeach; ?>
	</ul>
</div>