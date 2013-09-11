<div id="navbar" class="<?= isset($navbarclass) ? $navbarclass : 'navbar navbar-fixed-top' ?>">
	<div class="navbar-inner">
		<div class="container">
			<a href="<?= url(Config::get('app.brandurl')) ?>" class="brand"><?= trans('common.brandname') ?></a>
<?php		foreach ($menu as $lrkey => $lr): ?>
<?php		$cnt = 0; ?>
			<ul class="nav<?= $lrkey == 'right' ? ' pull-right' : '' ?>">
<?php			foreach ($lr as $item): ?>
<?php			if (empty($item->items)): ?>
				<li<?= $item->selected ? ' class="active"' : '' ?>>
					<a href="<?= route($item->route) ?>"><?= empty($item->icon) ? '' : '<i class="'.$item->icon.'"></i> ' ?><?= $item->content ?></a>
				</li>
<?php			else: ?>
				<li class="dropdown<?= $item->selected ? ' active' : '' ?>">
					<a href="<?= route($item->route) ?>" class="dropdown-toggle" data-toggle="dropdown"><?= empty($item->icon) ? '' : '<i class="'.$item->icon.'"></i> ' ?><?= $item->content ?><b class="caret"></b></a>
					<ul class="dropdown-menu">
<?php				foreach ($item->items as $item2): ?>
						<li<?= $item2->selected ? ' class="active"' : '' ?>>
							<a href="<?= route($item2->route) ?>"><?= empty($item2->icon) ? '' : '<i class="'.$item2->icon.'"></i> ' ?><?= $item2->content ?></a>
						</li>
<?php				endforeach; ?>
					</ul>
				</li>
<?php			endif; ?>
<?php			if (++$cnt < count($lr)): ?>
				<li class="divider-vertical"></li>
<?php			endif; ?>
<?php			endforeach; ?>
			</ul>
<?php		endforeach; ?>
		</div>
	</div>
</div>

