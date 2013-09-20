<?php if (!empty($heading)): ?>
<div class="page-header">
<h3><?= $heading ?></h3>
</div>
<?php endif; ?>
<?= HTML::_messages($errors->all()) ?>
<p>&nbsp;</p>
<?php if (isset($links)): ?>
<?php foreach($links as $link => $name): ?>
<a href="<?= $link ?>" class="btn"><?= $name ?></a>&nbsp;
<?php endforeach; ?>
<?php endif; ?>