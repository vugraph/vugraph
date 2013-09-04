<?php $usermenu = array(
	'admin' => array(),
	'kullanici/' => array(
		'kullanici/hesap-bilgileri' => array(),
		'kullanici/sifre-degistir' => array()
	),
	'cikis' => array()
	/*
	'licence' => array(
		'lisans-yetkilisi' => array(
			'lisans-yetkilisi/lisans' => array(),
			'lisans-yetkilisi/vize' => array()
		)
	),
	'national' => array(
		'ulusal-yetkili' => array(
			'ulusal-yetkili/turnuva-girisi' => array()
		)
	),
	'regional' => array(
		'bolgesel-yetkili' => array(
			'bolgesel-yetkili/turnuva-girisi' => array()
		)
	),
	'club' => array(
		'kulup-yetkilisi' => array(
			'kulup-yetkilisi/turnuva-girisi' => array()
		)
	),
	'player' => array(
		'sporcu' => array(
			'sporcu/lisans-bilgileri' => array(),
			'sporcu/online-vize' => array()				
		)
	),
	*/
);
?>
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