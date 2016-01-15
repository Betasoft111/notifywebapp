$(document).ready(function() {
/***************************    Tabs*****************************/
var i=0;
	$('#tabs').tabs({
		select: function(event, ui) {
			// second tab selected, do something
			overlayShow();
			i = (ui.index*1)+1;
			$.ajax({
				url:ajax_url+'admin/users/tabs/'+ui.index,
				success:function(resp)
				{
					$('#tabs-'+i).html(resp);
					overlayHide();
				}
			})
		}
	});
	 $(".pagination a, .header a").live('click',function(){
	 alert(i);
			overlayShow();
			$('#content').load(unescape($(this).attr("href")),function(){						
				$('a.asc').parent('th').addClass('headerSortDown');
				$('a.desc').parent('th').addClass('headerSortUp');
				overlayHide();
				$('.tooltip').tooltip({
					track: true,
					delay: 0,
					showURL: false,
					showBody: " - ",
					fade: 250
					});
			 });		
			 return false;
	   }); 
});