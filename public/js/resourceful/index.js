function setPerPage(perPage) {
	$('#perpage'+perPage).prop('checked', true);
	$('#input-perpage').val(perPage);
	$('#form-perpage').submit();
	$(document.body).fadeOut();
	return false;
}
function getReplacedUri(replace) {
	var vars = {}, hash;
	var u = document.URL.split('?');
	q = u[1];
	if(q !== undefined){
		q = q.split('&');
		for (var i = 0; i < q.length; i++) {
			hash = q[i].split('=');
			if (hash[0] === 'perpage' || (hash[0] in replace)) continue;
			vars[hash[0]] = hash[1];
		}
	}
	for (var qs in replace) if (replace[qs] && replace[qs] !== '0') vars[qs] = replace[qs];
	url = $.param(vars);
	if (url) url = u[0] + '?' + url;
	else url = u[0];
	return url;
}

$(function() {
	ff = $('#form-filters');
	fdt = $('#data-table');
	if (ff) {
		search = $('#search');
		selects = ff.find('select');
		selects.on('change', function() {
			if (!$(this).val()) $(this).prop('disabled', true);
			search.prop('disabled', true);
			ff.submit();
			$(document.body).fadeOut();
		});
		search.on('keypress', function(e) {
			code = e.keyCode ? e.keyCode : e.which;
			if (code === 13) {
				e.preventDefault();
				if (search.val()) {
					selects.prop('disabled', true);
					ff.submit();
					$(document.body).fadeOut();
				}
			}
		});
		$('#search-reset').on('click', function(e) {
			e.preventDefault();
			search.prop('disabled', true);
			selects.prop('disabled', true);
			ff.submit();
			$(document.body).fadeOut();
		});
	}
	if (fdt) {
		fdt.find('.delete').on('click', function(e) {
			e.preventDefault();
			if (confirm(fdt.data('delete-dialog'))) {
				fdt.attr('action', $(this).data('action'));
				fdt.submit();
				$(document.body).fadeOut();
			}
		});
		fdt.find('.edit').on('click', function() {
			$(document.body).fadeOut();
		});
	}
});