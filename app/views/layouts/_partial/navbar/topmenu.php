<div id="navbar" class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a href="<?= url('/') ?>" class="brand"><i class="icon-home" style="vertical-align: baseline"></i> <?= trans('common.sitename') ?></a>
			<ul class="nav">
<?php		foreach ($topmenu as $path => $submenu): ?>
<?php			if (empty($submenu)): ?>
				<li<?= Request::path() == $path ? ' class="active"' : '' ?>>
					<?= link_to($path, trans("menu.$path"))."\n" ?>
				</li>
<?php			else: ?>
				<li class="dropdown<?= Request::path() == $path || array_key_exists(Request::path(), $submenu)  ? ' active' : '' ?>">
					<a href="<?= url($path) ?>" class="dropdown-toggle" data-toggle="dropdown"><?= trans("menu.$path") ?><b class="caret"></b></a>
					<ul class="dropdown-menu">
<?php					foreach ($submenu as $path2 => $value2): ?>
						<li<?= Request::path() == $path2 ? ' class="active"' : '' ?>>
							<?= link_to($path2, trans("menu.$path2"))."\n" ?>
						</li>
<?php					endforeach; ?>
					</ul>
				</li>
<?php			endif; ?>
<?php			endforeach; ?>
			</ul>
			<div class="nav-collapse collapse">
				<form class="navbar-search pull-right">
					<input type="text" class="search-query" placeholder="Arama">
				</form>
			</div>
		</div>
	</div>
</div>