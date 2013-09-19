$(function() {
//	console.log($('form#destroy').find('button.destroy'));
	f = $('form#destroy');
//	f.on('submit', function() {
//	});
	f.find('button.destroy').on('click', function(e) {
		e.preventDefault();
		if (confirm(f.data('delete-dialog'))) {
			$(document.body).fadeOut();
			$('form#destroy')
				.attr('action', $(this).data('action'))
				.submit();
		}
		return false;
	});
	$('ul#perpage').find('a').on('click', function() {
		$(document.body).fadeOut();
		return true;
	});
	$('#filterbutton').on('click', function() {
		$('#filter').toggle();
	});
});