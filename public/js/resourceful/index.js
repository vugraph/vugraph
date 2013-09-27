function getReplacedQueryString(replace) {
	var vars = {}, hash;
	var q = document.URL.split('?')[1];
	if(q !== undefined){
		q = q.split('&');
		for (var i = 0; i < q.length; i++) {
			hash = q[i].split('=');
			if (hash[0] === 'perpage' || (hash[0] in replace)) continue;
			vars[hash[0]] = hash[1];
		}
	}
	for (var qs in replace) if (replace[qs] && replace[qs] !== '0') vars[qs] = replace[qs];
	return $.param(vars);
}

$(function() {
	f = $('form#data-table');
	$('select#city').on('change', function() {
		$(document.body).fadeOut();
		window.location.search = getReplacedQueryString({ city: this.options[this.selectedIndex].value, search: null, page: null });
	});
	$('#search').on('keypress', function(e) {
		code = e.keyCode ? e.keyCode : e.which;
		if (code === 13) {
			search = $(this).val();
			if (search) {
				$(document.body).fadeOut();
				window.location.search = getReplacedQueryString({ city: null, search: search, page: null });
			}
		}
	});
	f.find('.delete').on('click', function(e) {
		e.preventDefault();
		if (confirm(f.data('delete-dialog'))) {
			f.attr('action', $(this).data('action'));
			f.submit();
			$(document.body).fadeOut();
		}
	});
	f.find('.edit').on('click', function(e) {
		$(document.body).fadeOut();
	});
	$('ul#perpage').find('a').on('click', function() {
		$(document.body).fadeOut();
		return true;
	});
	$('#filterbutton').on('click', function() {
		$('#filter').toggle();
	});
});