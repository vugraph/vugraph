<div id="navbar" class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<?= link_to('/', Config::get('app.sitename'), array('class' => 'brand'))."\n" ?>
			<ul class="nav">
<?php		foreach ($topmenu as $link => $item): ?>
<?php			if (is_array($item)): ?>
				<li class="dropdown<?= Request::path() == $link || is_array($item['items']) && array_key_exists(Request::path(), $item['items']) ? ' active' : '' ?>">
					<a href="<?= url($link) ?>" class="dropdown-toggle" data-toggle="dropdown"><?= $item['title'] ?><b class="caret"></b></a>
					<ul class="dropdown-menu">
<?php					foreach ($item['items'] as $link2 => $item2): ?>
						<li<?= $link2 == Request::path() ? ' class="active"' : '' ?>>
							<?= link_to($link2, $item2)."\n" ?>
						</li>
<?php					endforeach; ?>
					</ul>
				</li>
<?php			else: ?>
				<li<?= $link == Request::path() ? ' class="active"' : '' ?>>
					<?= link_to($link, $item)."\n" ?>
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