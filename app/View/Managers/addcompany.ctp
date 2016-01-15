<!doctype html>
<style>
.input.time > select {
  width: 32.5%;
}
.first {
  float: left;
  margin-right: 10px;
}
</style>
<html class="no-js" lang="en">

  <head>

    <title>Home Page</title>
 
  </head>

  <body>
      <div class="main_wrapper">
    <?php echo $this->element('header'); ?>
<!--end of header-->
<section>
<div class="main_content">
<div class="row Heading">
<h1>Add/Edit Company</h1>
<div class="all_content">
<div class="large-12 columns">
<h6><a href="<?php echo HTTP_ROOT."managers/companylist"; ?>">Listing</a></h6>
</div>
<div class="large-6 large-centered medium-6 medium-centered small-12 columns">
<?php echo $this->Form->create('Company'); ?>
<label>Company Name<span class="star">*</span></label>
<?php echo $this->Form->input('id',array('label'=>false, 'type'=>'hidden','value'=>@$companydata['Company']['id'])); ?>
<?php echo $this->Form->input('companyName',array('label'=>false, 'placeholder'=>'Company name' ,'value'=>@$companydata['Company']['companyName'])); ?>
<label>Start Time<span class="star">*</span></label>
<?php echo $this->Form->input('startTime',array('label'=>false, 'placeholder'=>'Start time','value'=>date("g:i a",strtotime(@$companydata['Company']['startTime'])))); ?>
<label>End Time<span class="star">*</span></label>
<?php echo $this->Form->input('endTime',array('label'=>false, 'placeholder'=>'End time','value'=>date("g:i a",strtotime(@$companydata['Company']['endTime'])))); ?>
<label>Repeat On<span class="star">*</span></label>
<?php $sizes = array(''=>'Select','DAILY' => 'DAILY', 'MON_TO_FRI' => 'MON_TO_FRI', 'MON_WED_FRI' => 'MON_WED_FRI','TUE_THR'=>'TUE_THR','WEEKLY'=>'WEEKLY','MONTHLY'=>'MONTHLY','YEARLY'=>'YEARLY');
echo $this->Form->input(
    'repeatType',
    array('options' => $sizes, 'default' => 'Select','label'=>false ,'value'=>@$companydata['Company']['repeatType'])
);
?>
<div class="repeatday" style="display:<?php echo @$companydata['Company']['repeatType']=='WEEKLY'?'block':'none'; ?>">
  <label class="first">S</label><input type="checkbox" class="checkday" <?php $valee=@$companydata['RepeatCompany'][0]['repeat_on']; if (preg_match('/SUN/',$valee)) { echo 'checked'; }?> value="SUN">
  <label>M</label><input type="checkbox" class="checkday" <?php $valee=@$companydata['RepeatCompany'][0]['repeat_on']; if (preg_match('/MON/',$valee)) { echo 'checked'; }?> value="MON">
  <label>T</label><input type="checkbox" class="checkday" <?php $valee=@$companydata['RepeatCompany'][0]['repeat_on']; if (preg_match('/TUE/',$valee)) { echo 'checked'; }?> value="TUE">
  <label>W</label><input type="checkbox" class="checkday" <?php $valee=@$companydata['RepeatCompany'][0]['repeat_on']; if (preg_match('/WED/',$valee)) { echo 'checked'; }?> value="WED">
  <label>T</label><input type="checkbox" class="checkday" <?php $valee=@$companydata['RepeatCompany'][0]['repeat_on']; if (preg_match('/THU/',$valee)) { echo 'checked'; }?> value="THU">
  <label>F</label><input type="checkbox" class="checkday" <?php $valee=@$companydata['RepeatCompany'][0]['repeat_on']; if (preg_match('/FRI/',$valee)) { echo 'checked'; }?> value="FRI">
  <label>S</label><input type="checkbox" class="checkday" <?php $valee=@$companydata['RepeatCompany'][0]['repeat_on']; if (preg_match('/SAT/',$valee)) { echo 'checked'; }?> value="SAT">
<input type="hidden" class="hidday" name="repeadDay" value="">
</div>
<div class="interval" style="display:<?php $val=@$companydata['Company']['repeatType'];if($val=='WEEKLY' || $val=='MONTHLY' || $val=='YEARLY'){ echo "block"; } else { echo "none"; } ?>">
  <label>Interval</label>
  <?php $size = array('0'=>'Select','1' => '1', '2' => '2', '3' => '3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30');
echo $this->Form->input(
    'interval',
    array('options' => $size, 'default' => 'Select','label'=>false ,'value'=>@$companydata['Company']['interval'])
); ?>
</div>
<label>Email<span class="star">*</span></label>
<?php echo $this->Form->input('email',array('label'=>false, 'placeholder'=>'company email','value'=>@$companydata['Company']['email'])); ?>
<label>Code<span class="star">*</span></label>
<?php echo $this->Form->input('code',array('label'=>false, 'placeholder'=>'Code','value'=>@$companydata['Company']['code'])); ?>
<label>Company Address<span class="star">*</span></label>
<?php echo $this->Form->input('address',array('label'=>false,'type'=>'textarea','row'=>5,'placeholder'=>'company address','value'=>@$companydata['Company']['address'])); ?>
<?php echo $this->Form->end(array('class'=>'Submit_button full_width','label'=>'Submit')); ?>

</div>
</div>

</div>
  </div>
</section>
<?php echo $this->element('footer'); ?>
      </div>

  </body>
</html>
<script>
$(document).ready(function(){
  var time="<?php echo date("g:i a",strtotime(@$companydata['Company']['startTime'])); ?>";
   var array=[];
   array =time.split(':');   
var h=array[0];
var m=array[1];
var array2=[];
array2=m.split(' ');
var mm=array2[0];
var ma=array2[1];

    $('#CompanyStartTimeHour option').filter(function() { 
      return ($(this).text() == h); //To select hour
    }).prop('selected', true); 
$('#CompanyStartTimeMin option').filter(function() { 
      return ($(this).text() == mm); //To select minute
    }).prop('selected', true);
$('#CompanyStartTimeMeridian option').filter(function() { 
      return ($(this).text() == ma); //To select Meridian
    }).prop('selected', true);

var time1="<?php echo date("g:i a",strtotime(@$companydata['Company']['endTime'])); ?>";
   var array1=[];
   array1 =time1.split(':');   
var h1=array1[0];
var m1=array1[1];
var array3=[];
array3=m1.split(' ');
var mm1=array3[0];
var ma1=array3[1];

    $('#CompanyEndTimeHour option').filter(function() { 
      return ($(this).text() == h1); //To select hour
    }).prop('selected', true); 
$('#CompanyEndTimeMin option').filter(function() { 
      return ($(this).text() == mm1); //To select minute
    }).prop('selected', true);
$('#CompanyEndTimeMeridian option').filter(function() { 
      return ($(this).text() == ma1); //To select Meridian
    }).prop('selected', true);

$('#CompanyRepeatType').on('change',function(){
   var wekym=$(this).val();
   if(wekym=='WEEKLY' || wekym=='MONTHLY' ||  wekym=='YEARLY')
   {
      if(wekym=='WEEKLY')
      {
        $('.repeatday').show();
        $('.interval').show();
      }
      else
      {
        $('.repeatday').hide();
        $('.interval').show();
      }

    
   }
   else
   {
    $('.repeatday').hide();
    $('.interval').hide();
   }
});
$(".checkday").change(function () {
   var allVals = [];
     $('.checkday:checked').each(function() {
        
      allVals.push($(this).val());
    });
$('.hidday').val(allVals);
    //alert(allVals);
});
var allVals = [];
     $('.checkday:checked').each(function() {
        
      allVals.push($(this).val());
    });
$('.hidday').val(allVals);

});

</script>
