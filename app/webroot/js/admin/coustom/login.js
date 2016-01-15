$(document).ready(function() {
/***************************    Tabs*****************************/
	$('#tabs').tabs({
		select: function(event, ui) {
			// second tab selected, do something
			$('.response-msg').hide();
		}
	});
	
	$('.response-msg').click(function()
	{
		$(this).slideUp();
	})
});