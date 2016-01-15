<!doctype html>
<style>
.reveal-modal {
    left: 0;
    margin: 0 auto;
    max-width: 36.5em;
    right: 0;
    width: 80%;
}
.loadimg {
  background: none repeat scroll 0 0 rgba(0, 0, 0, 0.3);
  height: 100%;
  left: 0;
  pointer-events: none;
  position: absolute;
  right: 0;
  top: 0;
  width: 100%;
  z-index: 2147483647;
}
.loadimg img {
  display: block;
  margin: 277px auto;
  width: 100px;
}
div#firstdiv {
height: 300px;
overflow-y: scroll;
}
</style>
<html class="no-js" lang="en">
  <head>

    <title>Home Page</title>
   
  </head>

  <body>
      <div class="main_wrapper">
      <?php echo $this->element('header');?>
<!--end of header-->
<section>
<div class="loadimg" style="display:none">
<img src="<?php echo HTTP_ROOT;?>/img/loading.gif"/>
</div>
<div class="main_content">
<div class="row Heading">
<h1>Event List</h1>
<div class="all_content">
<?php $teach=0; $roledata=$this->Session->read('Auth.User.Role');  foreach ($roledata as $roledatas) {
             if($roledatas['role']=='6')
             {
              $teach++;
             }
    }
if($teach=='1'){
?>
<h6><a href="<?php echo HTTP_ROOT."event/addevent"; ?>">Add</a><a class="deletelink" href="<?php echo HTTP_ROOT."event/delete/"; ?>">|Delete</a>
<input type="hidden" class="sendPush right" value="Get Notification" data-reveal-id="messagegetmodel"/>
<input type="button" class="sendPush right" value="Send Push Notification" data-reveal-id="messagemodel"/>
</h6>
<br/>
<?php } ?>
<?php $paginator = $this->Paginator; ?>
<table class="main_table">
  <thead>
    <tr>
      <th class="checkbox"><input type="checkbox" id="checkAll"></th>
      
       <?php echo "<th>" . $paginator->sort('eventName', 'Event Name') . "</th>"; ?>
       <?php echo "<th>" . $paginator->sort(' eventCode', 'Event Code') . "</th>"; ?>
       <th >Eventee</th>
      <th >Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php if(!empty($eventdata)){foreach ($eventdata as $eventdatas) {?>
   <tr>
      <td class="checkbox"><input type="checkbox" class="check" value="<?php echo $eventdatas['Event']['id']; ?>"></td>
      <td><a href="<?php echo HTTP_ROOT."event/eventeeView/".$eventdatas['Event']['id']; ?>"><?php echo $eventdatas['Event']['eventName']; ?></a></td>
      <td><?php echo @$eventdatas['Event']['eventCode']; ?></td>
      <td><?php $i='0'; if(!empty($eventdatas['Eventee'])){
    foreach($eventdatas['Eventee'] as $diss)
{
$i++;
}

echo $i; } else { echo '0'; }?></td>
      <td class="actions2"><span><a href="<?php echo HTTP_ROOT."school/school"; ?>">View / </a></span><?php if($teach=='1'){ ?><span><a href="<?php echo HTTP_ROOT."event/addevent/".$eventdatas['Event']['id']; ?>">Edit / </a></span><span><a href="<?php echo HTTP_ROOT."event/delete/".$eventdatas['Event']['id']; ?>">Delete</a></span><?php }?></td>
    </tr>
  <?php }} else {?>
<tr>
<td class="checkbox"></td>
  <td>No record Found</td>
<td></td>
<td></td>
<td></td>
</tr>
  <?php }?>
</tbody>

</table>

<?php 

echo "<div class='paging large-5 columns right'>";
 
        // the 'first' page button
        echo $paginator->first("First");
         
        // 'prev' page button, 
        // we can check using the paginator hasPrev() method if there's a previous page
        // save with the 'next' page button
        if($paginator->hasPrev()){
            echo $paginator->prev("Prev");
        }
         
        // the 'number' page buttons
        echo $paginator->numbers(array('modulus' => 2));
         
        // for the 'next' button
        if($paginator->hasNext()){
            echo $paginator->next("Next");
        }
         
        // the 'last' page button
        echo $paginator->last("Last");
     
    echo "</div>";



?>





</div>

</div>
  </div>
</section>
 <?php echo $this->element('footer');?>

      </div>
   </body>
<div id="messagegetmodel" class="reveal-modal large-5 large-centered" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
  <h2 id="modalTitle">School Owner's Message.</h2>
<div id="firstdiv">

<table>
  <thead>
    <tr>
      <th>Message</th>
      <th>Date and Time</th>
   </tr>
  </thead>
  <tbody>
  <?php if(!empty($datamsg)) { foreach($datamsg as $datamsgs) {?>
    <tr>
      <td title="<?php echo @$datamsgs['AllMessage']['message'] ?>"><?php 
echo $this->Text->truncate(@$datamsgs['AllMessage']['message'],
                       20,
                   array(
                         'ellipsis' => '...',
                         'exact' => true
                        ));
 ?></td>
      <td><?php echo @$datamsgs['AllMessage']['created']; ?></td>
    </tr>
    <?php } } else {?>
     <td><?php echo 'NO Message'; ?></td>
      <td></td>
    <?php }?>
  </tbody>
</table>


</div>
<a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>
<div id="messagemodel" class="reveal-modal large-5 large-centered" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
  <h2 id="modalTitle">Send Notification/Message to Eventee</h2>
<div id="firstdiv1">
<textarea id="message" name="message" placeholder="Message..." rows="4"></textarea>

</div>

<input type="button" value="Send" class="Submit_button" id="sendMessage">

  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>
</html>
<script>
$(document).ready(function(){
var proto=window.location.protocol;
        var host=window.location.host;
        var ajaxUrl=proto+'//'+host+'/attendance';
$("#checkAll").change(function () {
      $(".check").prop('checked', $(this).prop("checked"));
   //alert(chh);  
     var allVals = [];
     $('.check:checked').each(function() {
        
      allVals.push($(this).val());
    });
    $('.deletelink').attr('href','http://abdevs.com/attendance/event/delete/'+allVals); //alert(allVals);
});
$(".check").change(function () {
     // $(".check").prop('checked', $(this).prop("checked"));
   //alert(chh);  
     var allVals = [];
     $('.check:checked').each(function() {
        
      allVals.push($(this).val());
    });
    $('.deletelink').attr('href','http://abdevs.com/attendance/event/delete/'+allVals); //alert(allVals);
});
$(".Submit_button").on('click',function(){
   var mess=$('#message').val();
   if(mess=='')
{
return false;
}
else
{
$('.loadimg').show();
$.ajax({
            async:false,
            type:"POST",
            data:{message:mess},
            url: ajaxUrl+'/event/sendMessageToEventee',
            dataType: 'json',
            success:function(data){
                if(data!='')
                {
                     if(data.Message=='1')
                      {
                        $('.loadimg').hide();
                        $('.close-reveal-modal').trigger('click');
                        alert('Successfully send message to eventees');
                        $('#message').val('');
                         
                      }
                     else if(data.Message=='2')
                      {
                         $('.loadimg').hide();
                          $('.close-reveal-modal').trigger('click');
                         alert('Eventee not added'); 
                               $('#message').val('');
                      }
                      else
                      {
                         $('.loadimg').hide();
                          $('.close-reveal-modal').trigger('click');
                         alert('Events not added'); 
                              $('#message').val('');
                      }

                 }
            }
        });

}
     
 
});
});

</script>
