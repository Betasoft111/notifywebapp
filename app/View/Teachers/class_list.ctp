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
<h1>Classes List</h1>
<div class="all_content">
<?php $teach=0; $roledata=$this->Session->read('Auth.User.Role');  foreach ($roledata as $roledatas) {
             if($roledatas['role']=='1')
             {
              $teach++;
             }
    }
$prm=@$this->params['pass'][0];
?>
<h6>
<?php if($teach=='1'){ ?><a href="<?php echo HTTP_ROOT."teachers/classAdd"; ?>">Add</a><a class="deletelink" href="<?php echo HTTP_ROOT."teachers/delete/"; ?>">|Delete</a>
<input type="button" class="sendPush right" value="Get Notification" data-reveal-id="messagegetmodel"/>
<input type="button" class="sendPush right" value="Send Push Notification" data-reveal-id="messagemodel"/>
<?php } ?>
<?php if(!empty($prm)) {?>
<a class="right" href="<?php echo  "http://abdevs.com".$this->Html->url('exportAllClass', array('controller' => 'teachers', 'action' => 'exportAllClass','ext' => 'csv'))."/".$this->params['pass'][0]; ?>">Export CSV</a>
<?php } else {?>
<a class="right" href="<?php echo  "http://abdevs.com".$this->Html->url('exportAllClassOwn', array('controller' => 'teachers', 'action' => 'exportAllClassOwn','ext' => 'csv')); ?>">Export CSV</a>
<?php }?>
</h6>


<?php $paginator = $this->Paginator; ?>
<table class="main_table">
  <thead>
    <tr>
      <th class="checkbox"><input type="checkbox" id="checkAll"></th>
      
       <?php echo "<th>" . $paginator->sort('className', 'Class Name') . "</th>"; ?>
       <?php echo "<th>" . $paginator->sort(' classCode', 'Class Code') . "</th>"; ?>
       <th >Students</th>
      <th >Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php if(!empty($classdata)){foreach ($classdata as $classdatas) {?>
   <tr>
      <td class="checkbox"><input type="checkbox" class="check" value="<?php echo $classdatas['Teacher']['id']; ?>"></td>
      <td><a href="<?php echo HTTP_ROOT."school/studentView/".$classdatas['Teacher']['id']; ?>"><?php echo $classdatas['Teacher']['className']; ?></a></td>
      <td><?php echo @$classdatas['Teacher']['classCode']; ?></td>
      <td><?php $i='0'; if(!empty($classdatas['Student'])){
    foreach($classdatas['Student'] as $diss)
{
$i++;
}

echo $i; } else { echo '0'; }?></td>
      <td class="actions2"><span><a href="<?php echo HTTP_ROOT."school/school"; ?>">View  </a></span><?php if($teach=='1'){ ?><span><a href="<?php echo HTTP_ROOT."teachers/classAdd/".$classdatas['Teacher']['id']; ?>">/ Edit / </a></span><span><a href="<?php echo HTTP_ROOT."teachers/delete/".$classdatas['Teacher']['id']; ?>">Delete</a></span><?php }?></td>
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
  <h2 id="modalTitle">Send Notification/Message to Students</h2>
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
    $('.deletelink').attr('href','http://abdevs.com/attendance/teachers/delete/'+allVals); //alert(allVals);
});
$(".check").change(function () {
     // $(".check").prop('checked', $(this).prop("checked"));
   //alert(chh);  
     var allVals = [];
     $('.check:checked').each(function() {
        
      allVals.push($(this).val());
    });
    $('.deletelink').attr('href','http://abdevs.com/attendance/teachers/delete/'+allVals); //alert(allVals);
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
            url: ajaxUrl+'/teachers/sendMessageToStudent',
            dataType: 'json',
            success:function(data){
                if(data!='')
                {
                     if(data.Message=='1')
                      {
                        $('.loadimg').hide();
                        $('.close-reveal-modal').trigger('click');
                        alert('Successfully send message to students');
                        $('#message').val('');
                         
                      }
                     else if(data.Message=='2')
                      {
                         $('.loadimg').hide();
                          $('.close-reveal-modal').trigger('click');
                         alert('Student not added'); 
                               $('#message').val('');
                      }
                      else
                      {
                         $('.loadimg').hide();
                          $('.close-reveal-modal').trigger('click');
                         alert('Classes not added'); 
                              $('#message').val('');
                      }

                 }
            }
        });

}
     
 
});
});

</script>
