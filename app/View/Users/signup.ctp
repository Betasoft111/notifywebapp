 <div class="main_wrapper">
     <?php echo $this->element('header');?>
<!--end of header-->
<section class="login-cont">
  <div class="login-top-cont"><img src="<?php echo HTTP_ROOT;?>/images/notify-img.png" alt=""></div>
<div class="main_content">
<div class="row Heading">

<?php echo $this->Form->create('User'); ?>

<?php echo $this->Form->input('id',array('label'=>false, 'type'=>'hidden','value'=>@$userdatass['User']['id'])); ?>
<?php echo $this->Form->input('first_name',array( 'value'=>@$userdatass['User']['first_name'])); ?>

<?php echo $this->Form->input('last_name',array('value'=>@$userdatass['User']['last_name'])); ?>

<?php echo $this->Form->input('email',array('value'=>@$userdatass['User']['email'])); ?>

<?php echo $this->Form->input('password',array( 'value'=>@$userdatass['User']['password_dummy'])); ?>
<?php echo $this->Form->input('re_password', array('type'=>'password', 'label'=>'Confirm Password', 'value'=>'', 'autocomplete'=>'off'));?>

<?php echo $this->Form->input('school',array('value'=>@$userdatass['User']['school'])); ?>
<div style="display:<?php echo @$userdatass['User']['id']==''?'block':'none'; ?>">                             

<label>Organization Type<span class="star">*</span></label>
<?php $sizes = array(''=>'Select','School' => 'School', 'Event' => 'Event', 'Corporation' => 'Corporation','Healthcare'=>'Health care');
echo $this->Form->input(
    'userview',
    array('options' => $sizes, 'default' => 'Select','label'=>false, 'value'=>@$userdatass['User']['userview'])
);
?>

<div id="showUserType"  style="display:none;">
<label>User Type<span class="star">*</span></label>
<?php $usertype = array('4' => 'Manager', '10' => 'Company');
echo $this->Form->input(
    'healthusertype',
    array('options' => $usertype, 'default' => 'Manager','label'=>false )
);
?>
</div>

</div>
<div class="usertype" style="display:none;">
<label>User Type<span class="star">*</span></label>
<?php $usertype = array('8' => 'District Owner', '9' => 'School Owner', '1' => 'Teacher','3'=>'Parent');
echo $this->Form->input(
    'usertype',
    array('options' => $usertype, 'default' => 'District Owner','label'=>false )
);
?>
</div>
<!-- <div  class="schooloption" style="display:none;">
<label>Select any one School</label>
<select name="schoolid">
<?php // foreach ($schooldata as $schooldatas) { ?>
<option value="<?php //echo @$schooldatas['School']['id'] ?>"><?php //echo @$schooldatas['School']['school_name'] ?></option> 
<?php //} ?>
</select>
</div> -->

<?php echo $this->Form->input('question',array('value'=>@$userdatass['User']['question'])); ?>

<?php echo $this->Form->input('answer',array('value'=>@$userdatass['User']['answer'])); ?>
<?php echo $this->Form->end(array('class'=>'Submit_button full_width','label'=>'Submit')); ?>

</div>




</div>

</div>
  </div>
</section>
<?php echo $this->element('footer');?>
      </div>

<script> 
$(document).ready(function(){
   var $aSelected = $('div.email').find('div');
if( $aSelected.hasClass('error-message') ){ // .hasClass() returns BOOLEAN true/false
  $('#UserPassword').val('');
 
}
$('#UserUserview').on('change',function(){
   var userview = $(this).val();
   if(userview=='School')
   {
    $('.usertype').show();
   }
   else
   {
    $('.usertype').hide();
   }
});
$('.hideshow').on('click',function(){
var txxt=$(this).text();
if(txxt=='Show Password')
{
$('#UserPassword').get(0).type = 'text';
$(this).text('Hide Password');
}
else
{
$('#UserPassword').get(0).type = 'password';
$(this).text('Show Password');
}
//$('#UserPassword').prop('type','text');
});
$('#UserUserview').change(function () {
  var selectedVal = $(this).val();
  console.log('Selected ', selectedVal);
  if(selectedVal === 'Healthcare') {
    $('#showUserType').show();
  }else {
    $('#showUserType').hide();
  }
});
});
</script>