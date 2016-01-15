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
</style>
<html class="no-js" lang="en">
  <head>
 
    <title>School List</title>
   
  </head>

</script>
  <body>
      <div class="main_wrapper">
  <?php echo $this->element('header'); ?>
<!--end of header-->
<section>
<div class="loadimg" style="display:none">
<img src="<?php echo HTTP_ROOT;?>/img/loading.gif"/>
</div>
<div class="main_content">
<div class="row Heading">
<h1>Districts List</h1>
<div class="all_content">
<h6><a href="<?php echo HTTP_ROOT."school/districtAdd"; ?>">Add |</a><a class="deletelink" href="<?php echo HTTP_ROOT."school/deleteDistrict/"; ?>">Delete</a>
<input type="button" class="sendPush right" value="Send Push Notification" data-reveal-id="messagemodel"/>
</h6>

<br/>
<?php $paginator = $this->Paginator; ?>
<table class="main_table">
  <thead>
    <tr>
      <th class="checkbox"><input type="checkbox" id="checkAll"></th>
      <?php echo "<th>" . $paginator->sort('district_name', 'District Name') . "</th>"; ?>
      <?php echo "<th class='dcode'>" . $paginator->sort('district_code', 'District Code') . "</th>"; ?>
      <th >Schools</th>
      <th >Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php if(!empty($districtdata)){foreach ($districtdata as $districtdatas) {?>
    <tr>
      <td class="checkbox"><input type="checkbox" class="check" value="<?php echo $districtdatas['District']['id']; ?>"></td>
      <td><a href="<?php echo HTTP_ROOT."school/schoolList/".$districtdatas['District']['id']; ?>"><?php echo @$districtdatas['District']['district_name']; ?></a></td>
      <td><?php echo @$districtdatas['District']['district_code']; ?></td>
      <td><?php $i='0'; if(!empty($districtdatas['School'])){
    foreach($districtdatas['School'] as $diss)
{
$i++;
}

echo $i; } else { echo '0'; }?></td>
      <td class="actions"><span><a href="#">View / </a><a href="<?php echo HTTP_ROOT."school/districtAdd/".$districtdatas['District']['id']; ?>">Edit / </a></span><span><a href="<?php echo HTTP_ROOT."school/deleteDistrict/".$districtdatas['District']['id']; ?>">Delete</a></span></td>
    </tr>
   <?php } } else {?>
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
<?php echo $this->element('footer'); ?>

      </div>
</body>
<div id="messagemodel" class="reveal-modal large-5 large-centered" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
  <h2 id="modalTitle">Send Message to School</h2>
<div id="secdiv">
<select id="optionselect">
  <option value="">Select</option>
  <option value="1">All(School's Owner, Teachers and Students)</option>
  <option value="2">School's Owners</option>
  <option value="3">Teachers</option>
  <option value="4">Students</option>
</select>
<span class="errmsg star" style="display:none">Please select any one first</span>
</div>

<div id="firstdiv">
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
    $('.deletelink').attr('href','http://abdevs.com/attendance/school/deleteDistrict/'+allVals); //alert(allVals);
});
$(".check").change(function () {
     // $(".check").prop('checked', $(this).prop("checked"));
   //alert(chh);  
     var allVals = [];
     $('.check:checked').each(function() {
        
      allVals.push($(this).val());
    });
    $('.deletelink').attr('href','http://abdevs.com/attendance/school/deleteDistrict/'+allVals); //alert(allVals);
});
$(".Submit_button").on('click',function(){
   var mess=$('#message').val();
   var opt=$('#optionselect').val();
   if(mess=='' || opt=='')
{
$('.errmsg').show();
return false;
}
else
{
$('.errmsg').hide();
$('.loadimg').show();
$.ajax({
            async:false,
            type:"POST",
            data:{message:mess},
            url: ajaxUrl+'/school/sendMessage/'+opt,
            dataType: 'json',
            success:function(data){
                if(data!='')
                {
                     if(data.Message=='1')
                      {
                        $('.loadimg').hide();
                        $('.close-reveal-modal').trigger('click');
                        alert('Successfully sent message');
                        $('#message').val('');
                         
                      }
                     else if(data.Message=='2')
                      {
                         $('.loadimg').hide();
                          $('.close-reveal-modal').trigger('click');
                         alert('Schools are not added'); 
                               $('#message').val('');
                      }
                      else
                      {
                         $('.loadimg').hide();
                          $('.close-reveal-modal').trigger('click');
                         alert('District are not added'); 
                              $('#message').val('');
                      }

                 }
            }
        });

}
     
 
});
});

</script>
