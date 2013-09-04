<div id="navbar" class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a href="<?= url(Config::get('app.brandurl')) ?>" class="brand"><?= trans('common.brandname') ?></a>
			<ul class="nav">
<?php			foreach ($menu['left'] as $item): ?>
<?php			if (empty($item->items)): ?>
				<li<?= $item->selected ? ' class="active"' : '' ?>>
					<a href="<?= route($item->route) ?>"><?= empty($item->icon) ? '' : '<i class="'.$item->icon.'"></i> ' ?><?= trans('menu.'.$item->route) ?></a>
				</li>
<?php			else: ?>
				<li class="dropdown<?= $item->selected ? ' active' : '' ?>">
					<a href="<?= route($item->route) ?>" class="dropdown-toggle" data-toggle="dropdown"><?= trans('menu.'.$item->route) ?><b class="caret"></b></a>
					<ul class="dropdown-menu">
<?php				foreach ($item->items as $item2): ?>
						<li<?= $item2->selected ? ' class="active"' : '' ?>>
							<?= link_to_route($item2->route, trans('menu.'.$item2->route))."\n" ?>
						</li>
<?php				endforeach; ?>
					</ul>
				</li>
<?php			endif; ?>
<?php			endforeach; ?>
			</ul>
			<ul class="nav pull-right">
<?php			foreach ($menu['right'] as $item): ?>
				<li<?= $item->selected ? ' class="active"' : '' ?>>
					<a href="<?= route($item->route) ?>"><?= empty($item->icon) ? '' : '<i class="'.$item->icon.'"></i> ' ?><?= trans('menu.'.$item->route) ?></a>
				</li>
<?php			endforeach; ?>
			</ul>
		</div>
	</div>
</div>