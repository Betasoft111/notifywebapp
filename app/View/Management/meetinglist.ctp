<div class="main_wrapper">
  <?php echo $this->element('header');?>
  <!--end of header-->
  <section>
    <div class="loadimg" style="display:none">
      <img src="<?php echo HTTP_ROOT;?>/img/loading.gif"/>
    </div>
    <div class="main_content">
      <div class="row Heading">
        <h1>School List</h1>
        <div class="all_content">
          <?php $sown=0; $roledata=$this->Session->read('Auth.User.Role'); 
           foreach ($roledata as $roledatas) {
          if(($roledatas['role']=='4')||($roledatas['role']=='10'))
          {
          $sown++;
          }
          }
          $user_id=$this->Session->read('Auth.User.User.id');
          $prm=@$this->params['pass'][0];
          ?>
          <h6>
          <?php if($sown=='1'){ ?>
          <a href="<?php echo HTTP_ROOT."management/Meetingadd"; ?>">Add</a>
          <a class="deletelink" href="<?php echo HTTP_ROOT."management/delete/"; ?>">|Delete</a>
          <input type="button" class="sendPush right" value="Get Notification" data-reveal-id="messagegetmodel"/>
          <input type="button" class="sendPush right" value="Send Push Notification" data-reveal-id="messagemodel"/>
          <?php } ?>
          <?php if(!empty($prm)) {?>
          <a class="right" href="<?php echo  "http://abdevs.com".$this->Html->url('exportSchool', array('controller' => 'school', 'action' => 'exportSchool','ext' => 'csv'))."/".@$this->params['pass'][0]; ?>"> Export CSV  </a>
          <?php } else {?>
          <a class="right" href="<?php echo  "http://abdevs.com".$this->Html->url('exportSchoolown', array('controller' => 'school', 'action' => 'exportSchoolown','ext' => 'csv')); ?>"> Export CSV  </a>
          <?php }?>
          </h6>
          <br/>
          <?php $paginator = $this->Paginator; ?>
          <table class="main_table">
            <thead>
              <tr>
                <th class="checkbox"><input type="checkbox" id="checkAll"></th>
                
                <?php echo "<th>" . $paginator->sort('employee_name', 'Employee Name') . "</th>"; ?>
                <?php echo "<th>" . $paginator->sort('employee_email', 'Employee Email') . "</th>"; ?>
                
                <th >Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php if(!empty($schedules)){

                foreach ($schedules as $employee) {

                ?>
              <tr>
                <td class="checkbox"><input type="checkbox" class="check" value="<?php echo $employee['Employee']['id']; ?>"></td>

                <td><a href="<?php echo HTTP_ROOT."teachers/classList/".$employee['Employee']['id']; ?>"><?php echo $employee['Employee']['employee_name']; ?></a></td>
                <td><?php echo @$employee['Employee']['employee_email']; ?></td>
                
                 
                  <td class="actions2">
                    <span><a href="<?php echo HTTP_ROOT."management/view/".$employee['Employee']['id']; ?>">View </a></span><?php if($sown=='1'){ ?>
                    <span><a href="<?php echo HTTP_ROOT."management/edit/".$employee['Employee']['id']; ?>">/ Edit / </a></span><span><a href="<?php echo HTTP_ROOT."management/delete/".$employee['Employee']['id']; ?>">Delete</a></span><?php }?></td>
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
 
<div id="messagegetmodel" class="reveal-modal large-5 large-centered" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
    <h2 id="modalTitle">District Owner's Message.</h2>
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
          <td><?php echo @$datamsgs['AllMessage']['message']; ?></td>
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
    <h2 id="modalTitle">Send Notification/Message</h2>
  <div id="secdiv">
    <select id="optionselect">
        <option value="">Select</option>
        <option value="1">All(Teachers and Students)</option>
        <option value="2">Teachers</option>
        <option value="3">Students</option>
    </select>
    <span class="errmsg star" style="display:none">Please select any one first</span>
  </div>
  <div id="firstdiv1">
    <textarea id="message" name="message" placeholder="Message..." rows="4"></textarea>
  </div>
  <input type="button" value="Send" class="Submit_button" id="sendMessage">
    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>

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
    $('.deletelink').attr('href','http://abdevs.com/attendance/school/delete/'+allVals); //alert(allVals);
});
$(".check").change(function () {
     // $(".check").prop('checked', $(this).prop("checked"));
   //alert(chh);  
     var allVals = [];
     $('.check:checked').each(function() {
        
      allVals.push($(this).val());
    });
    $('.deletelink').attr('href','http://abdevs.com/attendance/school/delete/'+allVals); //alert(allVals);
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
            url: ajaxUrl+'/school/sendMessageToTeacher/'+opt,
            dataType: 'json',
            success:function(data){
                if(data!='')
                {
                     if(data.Message=='1')
                      {
                        $('.loadimg').hide();
                        $('.close-reveal-modal').trigger('click');
                        alert('Successfully send message');
                        $('#message').val('');
                         
                      }
                     else if(data.Message=='2')
                      {
                         $('.loadimg').hide();
                          $('.close-reveal-modal').trigger('click');
                         alert('Teacher not added'); 
                               $('#message').val('');
                      }
                      else
                      {
                         $('.loadimg').hide();
                          $('.close-reveal-modal').trigger('click');
                         alert('School not added'); 
                              $('#message').val('');
                      }
                 }
            }
        });
}
     
 
});
});
</script>