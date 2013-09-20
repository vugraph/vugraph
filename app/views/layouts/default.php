<!doctype html>
<html lang="tr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="">
<meta name="author" content="Guray Sunamak, Odeva Internet Teknolojileri - www.odeva.com">
<meta name="description" content="">
<?php if (!empty($page->title)): ?>
<title><?= $page->title ?></title>
<?php endif; ?>
<?= HTML::style('css/bootstrap.css') ?>
<?php //HTML::style('css/bootstrap-responsive.css') ?>
<?= HTML::style('css/style.css') ?>
<?php if (!empty($page->styleFiles)): ?>
<?php foreach($page->styleFiles as $s): ?>
<?= HTML::style($s) ?>
<?php endforeach; ?>
<?php endif; ?>
<?php if (!empty($page->style)): ?>
<style>
<?= $page->style ?>
</style>
<?php endif; ?>
<!--[if lt IE 9]>
<?= HTML::script('js/html5shiv.js') ?>
<![endif]-->
<link rel="shortcut icon" href="<?= asset('favicon.ico') ?>">
</head>
<body>
<div id="container" class="container">
<?= empty($navbar) ? '' : $navbar."\n" ?>
<?= empty($breadcrumb) ? '' : $breadcrumb."\n" ?>
<div id="middle" class="row">
<?php if (!empty($sidebar)): ?>
<div id="sidebar" class="span3">
<!--p><a href="<?= route('home') ?>" title="<?= trans('common.brandname') ?>"><?= HTML::image('img/blank.gif', 'Logo', array('class' => 'img-circle img-polaroid', 'width' => '140', 'height' => '140')) ?></a></p-->
<?= $sidebar."\n" ?>
</div>
<?php endif; ?>
<div class="span<?= empty($sidebar) ? '12' : '9' ?>">
<div id="content">
<?= $content."\n" ?>
</div>
</div>
</div>
<div id="footer" class="text-center">
<hr>
&copy; <?= link_to(Config::get('app.brandurl'), trans('common.brandname')) ?>, 2013<?= date('Y') > 2013 ? '-'.date('Y') : '' ?>. Design by <?= link_to('http://www.odeva.com', 'Odeva') ?>.
<p>&nbsp;</p>
</div>
<p>&nbsp;</p>
</div>
<?= HTML::script('js/jquery-1.10.2.js') ?>
<?= HTML::script('js/bootstrap.js') ?>
<?php if (!empty($page->scriptFiles)): ?>
<?php foreach($page->scriptFiles as $s): ?>
<?= HTML::script($s) ?>
<?php endforeach; ?>
<?php endif; ?>
<?php if (!empty($page->script)): ?>
<script>
<?= $page->script ?>
</script>
<?php endif; ?>
<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
<ul>
<?php
foreach(DB::getQueryLog() as $sql) {
	echo '<li><dl>';
	foreach ($sql as $key => $item) {
		echo '<dt>'.$key.'</dt>';
		echo '<dd>';
		print_r($item);
		echo '</dd>';
	}
	echo '</dl></li>'."\n";
}
?>
</ul>
<?php
echo '<dl>'."\n";
foreach(array('GET' => $_GET, 'POST' => $_POST, 'SESSION' => $_SESSION) as $key => $value) {
	if (empty($value)) continue;
	echo '<dt>'.$key.'</dt>'."\n";
	echo '<dd><pre>'."\n";
	var_dump($value);
	echo '</pre></dd>'."\n";
}
echo '</dl>'."\n";
?>
</body>
</html>