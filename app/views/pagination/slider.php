<?php
	$presenter = new Illuminate\Pagination\BootstrapPresenter($paginator);
	$total = $paginator->getTotal();
?>

<?php if ($paginator->getLastPage() > 1): ?>
	<div class="pagination pagination-centered">
		<ul>
			<?php echo $presenter->render(); ?>
		</ul>
	</div>
	<div class="text-center"><?= trans('pagination.showing', array('total' => $total, 'first' => $paginator->getFrom(), 'last' => $paginator->getTo())) ?></div>
<?php else: ?>	
	<div class="text-center"><?= trans_choice('pagination.total', $total, compact('total')) ?></div>
<?php endif; ?>