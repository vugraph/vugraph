<!doctype html>
<html lang="tr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="">
<meta name="author" content="Guray Sunamak, Odeva Internet Teknolojileri - www.odeva.com">
<meta name="description" content="">
<?php if (isset($title)): ?>
<title><?= $title ?></title>
<?php endif; ?>
<?= HTML::style('css/bootstrap.css') ?>
<?= HTML::style('css/bootstrap-responsive.css') ?>
<?= HTML::style('css/style.css') ?>
<?php if (isset($style)): ?>
<style>
<?= $style."\n" ?>
</style>
<?php endif; ?>
<!--[if lt IE 9]>
<?= HTML::script('js/html5shiv.js') ?>
<![endif]-->
<link rel="shortcut icon" href="<?= asset('favicon.ico') ?>">
</head>
<body>
<div id="container" class="container">
<?= isset($navbar) ? $navbar."\n" : '' ?>
<?= isset($breadcrumb) ? $breadcrumb."\n" : '' ?>
<div id="sidebar" class="span2">
<?php if (isset($sidebar)): ?>
<div id="middle" class="row">
<p><a href="<?= url() ?>" title="<?= Config::get('app.sitename') ?>"><?= HTML::image('img/blank.gif', 'Logo', array('class' => 'img-circle img-polaroid', 'width' => '140', 'height' => '140')) ?></a></p>
<?= $sidebar."\n" ?>
</div>
<div id="content" class="span10">
<?= $content."\n" ?>
</div>
</div>
<?php else: ?>
<div id="content">
<?= $content."\n" ?>
</div>
<?php endif; ?>
<div id="footer" class="text-center">
<hr>
&copy; <?= link_to('/', Config::get('app.sitename')) ?>, 2013<?= date('Y') > 2013 ? '-'.date('Y') : '' ?>. Design by <?= link_to('http://www.odeva.com', 'Odeva') ?>.
<p>&nbsp;</p>
</div>
<p>&nbsp;</p>
</div>
<?= HTML::script('js/jquery-1.10.2.js') ?>
<?= HTML::script('js/bootstrap.js') ?>
</body>
</html>