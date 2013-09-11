<?php if (!empty($title)): ?>
<div class="page-header">
<h3><?= $title ?></h3>
</div>
<?php endif; ?>
<?= HTML::_messages($errors->all()) ?>
<p>&nbsp;</p>