$(document).ready(function() {
	$('#need-help-link').popover({
		container: 'body',
		content: $('meta[name=help-content]').attr('content'),
		html: true,
		placement: 'bottom',
		title: $('meta[name=help-content-title').attr('content'),
		trigger: 'click'
	});
});

$(window).resize(function() {
	$('#need-help-link').popover('hide');
});

$('#need-help-link').on('focusout', function() {
	$(this).popover('hide');
});