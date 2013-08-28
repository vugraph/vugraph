	<ul class="well nav nav-list">
<?php	$cnt = 0; ?>
<?php	foreach ($usermenu as $title => $items): ?>
		<li class="nav-header"><?= $title ?></li>
<?php	foreach ($items as $link => $item): ?>
<?php	if (is_array($item)): ?>
		<li<?= $link == Request::path() ? ' class="active"' : '' ?>>
			<a href="<?= url($link) ?>"><?= $item ?><b class="caret"></b></a>
		</li>
<?php	else: ?>
		<li<?= $link == Request::path() ? ' class="active"' : '' ?>>
			<?= link_to($link, $item) ?>
		</li>
<?php	endif; ?>
<?php	endforeach; ?>
<?php	if (++$cnt < count($usermenu)): ?>
		<li class="divider"></li>
<?php	endif; ?>
<?php	endforeach; ?>
	</ul>