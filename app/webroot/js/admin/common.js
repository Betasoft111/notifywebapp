var host = window.location.host;

var proto = window.location.protocol;

var ajax_url = proto+"//"+host+"/socialfit360/";

$(document).ready(function()
{
	 /***Overlay***/
   $('body').append('<div id="loading_overlay" style="display: none;"><div class="loading_message round_bottom" style="display: none;"> <img alt="loading" src="'+ajax_url+'img/loading.gif"></div></div>');  	
	/**end overlay**/
	/*** For tool tip**/				
	$('.tooltip').tooltip({
		track: true,
		delay: 0,
		showURL: false,
		showBody: " - ",
		fade: 250
		});
	/***for header menus**/
	$('ul#navigation').superfish({ 
		delay:       1000,
		animation:   {opacity:'show',height:'show'},
		speed:       'fast',
		autoArrows:  true,
		dropShadows: false,
	});
	$('ul#navigation li').hover(function(){
		$(this).addClass('sfHover2');
	},
	function(){
		$(this).removeClass('sfHover2');
	});	
	/***Ror header menus**/
	request = '';
	$('#notes').click(function(){
		$(this).parent().hide();
		$(this).parent().siblings('th').show();		
	})
	$('#notes-form input[type=button]').click(function()
	{
		$('#notes-form').parent().hide();
		$('#notes-form').parent().siblings('th').show();
	})
	$('#notes-form').submit(function()
	{
		$(this).find('img').show();
		if(request && request.readyState!=4)
		{
			request.abort();
		}
		request = $.ajax({
						url:ajax_url+'users/save_notes',
						data:$('#notes-form').serialize(),
						type:'post',
						success:function(data){
								$('#notes-form').find('img').hide();
								$('#notes').html(data);
								$('#notes-form').parent().hide();
								$('#notes').parent().show();
								date = new Date();
								var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sept", "Oct", "Nov", "Dec" ];
								$('.update-note').html('Updates at: '+monthNames[date.getMonth()]+'-'+date.getDay()+'-'+date.getFullYear());
							}
				})	
		request.fail(function (jqXHR, textStatus, errorThrown){
				// log the error to the console
				if($.trim(errorThrown)!='abort')
				{
					alert("Error occured: "+errorThrown);
				}
			});	 
		return false;
	})
	$('.response-msg').click(function()
	{
		$(this).slideUp();
	})
	$('.header input[type="checkbox"]').live('click',function(){
		if($(this).is(":checked")){
			$('td .checkbox').each(function(){
					$(this).attr("checked","checked");
		  });
	   }else{
			$('td .checkbox').each(function(){
					 $(this).attr("checked",false);
			});        
			}
	   });
	   /***To Check All rows***/
	   
	   
	   /***Pagination***/
	   $(".pagination a, .header a").live('click',function(){
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
	   /***End Pagination***/
	   
	   	   
	   /**** Perform Actions ****/
	   $('.action select').live('change',function()
	   {
		   val = $(this).val()
		   if(val == '')
		   	return false;
		   if($('td .checkbox').is(':checked'))
		   {
			   switch(val)
			   {
				   case '1':				  
				   	if(confirm('Are you sure to delete the selected records ?'))
					{
						$('#tableForm').submit();
					}
					else
					{
					   $(this).val('');
					}
				   break;
				   default:
				   $('#tableForm').submit();
			   }			   
		   }
		   else
		   {
			   alert('Please select atleast one record...!');
			   $(this).val('');
		   }
	   })
	
});
 function overlayShow()
{
	$('#loading_overlay').show();
	$('#loading_overlay').children().show();
}

function overlayHide()
{
	$('#loading_overlay').hide();
	$('#loading_overlay').children().hide();
}
