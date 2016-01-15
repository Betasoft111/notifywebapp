<!doctype html>
<style>
.input.time > select {
  width: 31.5%;
}
.input.date  > select {
  width: 31.5%;
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
<h1>Add/Edit Class</h1>
<div class="all_content">
<div class="large-12 columns">
<h6><a href="<?php echo HTTP_ROOT."teachers/classList"; ?>">Listing</a></h6>
</div>
<div class="large-6 large-centered medium-6 medium-centered small-12 columns">
<?php echo $this->Form->create('Teacher'); ?>
<label>Class Name<span class="star">*</span></label>
<?php echo $this->Form->input('id',array('label'=>false, 'type'=>'hidden','value'=>@$classdata['Teacher']['id'])); ?>
<?php echo $this->Form->input('className',array('label'=>false, 'placeholder'=>'Class name' ,'value'=>@$classdata['Teacher']['className'])); ?>
<label>School Code</label>
<?php echo $this->Form->input('school_code',array('label'=>false, 'placeholder'=>'School code','value'=>@$classdata['Teacher']['school_code'],'required'=>false)); ?>
<label>District Code</label>
<?php echo $this->Form->input('district',array('label'=>false, 'placeholder'=>'district (Optional)','value'=>@$classdata['Teacher']['district'])); ?>
<label>Start Date<span class="star">*</span></label>
<?php echo $this->Form->input('startDate',array('label'=>false, 'placeholder'=>'Start Date','value'=>@$classdata['Teacher']['startDate'])); ?>
<label>End Date<span class="star">*</span></label>
<?php echo $this->Form->input('endDate',array('label'=>false, 'placeholder'=>'End Date','value'=>@$classdata['Teacher']['endDate'])); ?>
<label>Start Time<span class="star">*</span></label>
<?php echo $this->Form->input('startTime',array('label'=>false, 'placeholder'=>'Start time','value'=>date("g:i a",strtotime(@$classdata['Teacher']['startTime'])))); ?>
<label>End Time<span class="star">*</span></label>
<?php echo $this->Form->input('endTime',array('label'=>false, 'placeholder'=>'End time','value'=>date("g:i a",strtotime(@$classdata['Teacher']['endTime'])))); ?>

<label>Repeat On<span class="star">*</span></label>
<?php $sizes = array(''=>'Select','DAILY' => 'DAILY', 'MON_TO_FRI' => 'MON_TO_FRI', 'MON_WED_FRI' => 'MON_WED_FRI','TUE_THR'=>'TUE_THR','WEEKLY'=>'WEEKLY','MONTHLY'=>'MONTHLY','YEARLY'=>'YEARLY');
echo $this->Form->input(
    'repeatType',
    array('options' => $sizes, 'default' => 'Select','label'=>false ,'value'=>@$classdata['Teacher']['repeatType'])
);
?>
<div class="repeatday" style="display:<?php echo @$classdata['Teacher']['repeatType']=='WEEKLY'?'block':'none'; ?>">
  <label class="first">S</label><input type="checkbox" class="checkday" <?php $valee=@$classdata['RepeatClass'][0]['repeat_on']; if (preg_match('/SUN/',$valee)) { echo 'checked'; }?> value="SUN">
  <label>M</label><input type="checkbox" class="checkday" <?php $valee=@$classdata['RepeatClass'][0]['repeat_on']; if (preg_match('/MON/',$valee)) { echo 'checked'; }?> value="MON">
  <label>T</label><input type="checkbox" class="checkday" <?php $valee=@$classdata['RepeatClass'][0]['repeat_on']; if (preg_match('/TUE/',$valee)) { echo 'checked'; }?> value="TUE">
  <label>W</label><input type="checkbox" class="checkday" <?php $valee=@$classdata['RepeatClass'][0]['repeat_on']; if (preg_match('/WED/',$valee)) { echo 'checked'; }?> value="WED">
  <label>T</label><input type="checkbox" class="checkday" <?php $valee=@$classdata['RepeatClass'][0]['repeat_on']; if (preg_match('/THU/',$valee)) { echo 'checked'; }?> value="THU">
  <label>F</label><input type="checkbox" class="checkday" <?php $valee=@$classdata['RepeatClass'][0]['repeat_on']; if (preg_match('/FRI/',$valee)) { echo 'checked'; }?> value="FRI">
  <label>S</label><input type="checkbox" class="checkday" <?php $valee=@$classdata['RepeatClass'][0]['repeat_on']; if (preg_match('/SAT/',$valee)) { echo 'checked'; }?> value="SAT">
<input type="hidden" class="hidday" name="repeadDay" value="">
<span class="errormsg star" style="display:none">please select any one first</span>
</div>
<div class="interval" style="display:<?php $val=@$classdata['Teacher']['repeatType'];if($val=='DAILY' || $val=='WEEKLY' || $val=='MONTHLY' || $val=='YEARLY'){ echo "block"; } else { echo "none"; } ?>">
  <label>Interval</label>
  <?php $size = array('0'=>'Select','1' => '1', '2' => '2', '3' => '3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30');
echo $this->Form->input(
    'interval',
    array('options' => $size, 'default' => 'Select','label'=>false ,'value'=>@$classdata['Teacher']['interval'])
); ?>
<span class="errormsg2 star" style="display:none">please select any one first</span>
</div>

<!-- label>code</label>
<?php //echo $this->Form->input('code',array('label'=>false, 'placeholder'=>'code (Optional)','value'=>@$classdata['Teacher']['code'])); ?>-->
<?php echo $this->Form->end(array('class'=>'Submit_button btnvalidate full_width','label'=>'Submit')); ?>

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
var sdate="<?php echo @$classdata['Teacher']['startDate']; ?>";
var datearray=[];
datearray=sdate.split('-');
var yer=datearray[0];
var mnth=datearray[1];
var dy=datearray[2]; 
$('#TeacherStartDateMonth option').filter(function() { 
      return ($(this).val() == mnth); //To select hour
    }).prop('selected', true); 
$('#TeacherStartDateDay option').filter(function() { 
      return ($(this).val() == dy); //To select minute
    }).prop('selected', true);
$('#TeacherStartDateYear option').filter(function() { 
      return ($(this).val() == yer); //To select Meridian
    }).prop('selected', true); 


var sdate1="<?php echo @$classdata['Teacher']['endDate']; ?>";
var datearray1=[];
datearray1=sdate1.split('-');
var yer1=datearray1[0];
var mnth1=datearray1[1];
var dy1=datearray1[2]; 
$('#TeacherEndDateMonth option').filter(function() { 
      return ($(this).val() == mnth1); //To select hour
    }).prop('selected', true); 
$('#TeacherEndDateDay option').filter(function() { 
      return ($(this).val() == dy1); //To select minute
    }).prop('selected', true);
$('#TeacherEndDateYear option').filter(function() { 
      return ($(this).val() == yer1); //To select Meridian
    }).prop('selected', true);



  var time="<?php echo date("g:i a",strtotime(@$classdata['Teacher']['startTime'])); ?>";
   var array=[];
   array =time.split(':');   
var h=array[0];
var m=array[1];
var array2=[];
array2=m.split(' ');
var mm=array2[0];
var ma=array2[1];

    $('#TeacherStartTimeHour option').filter(function() { 
      return ($(this).text() == h); //To select hour
    }).prop('selected', true); 
$('#TeacherStartTimeMin option').filter(function() { 
      return ($(this).text() == mm); //To select minute
    }).prop('selected', true);
$('#TeacherStartTimeMeridian option').filter(function() { 
      return ($(this).text() == ma); //To select Meridian
    }).prop('selected', true);

var time1="<?php echo date("g:i a",strtotime(@$classdata['Teacher']['endTime'])); ?>";
   var array1=[];
   array1 =time1.split(':');   
var h1=array1[0];
var m1=array1[1];
var array3=[];
array3=m1.split(' ');
var mm1=array3[0];
var ma1=array3[1];

    $('#TeacherEndTimeHour option').filter(function() { 
      return ($(this).text() == h1); //To select hour
    }).prop('selected', true); 
$('#TeacherEndTimeMin option').filter(function() { 
      return ($(this).text() == mm1); //To select minute
    }).prop('selected', true);
$('#TeacherEndTimeMeridian option').filter(function() { 
      return ($(this).text() == ma1); //To select Meridian
    }).prop('selected', true);

$('#TeacherRepeatType').on('change',function(){
   var wekym=$(this).val();
   if(wekym=='DAILY' || wekym=='WEEKLY' || wekym=='MONTHLY' ||  wekym=='YEARLY')
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
$(".btnvalidate").on('click', function(){
var wekym1=$('#TeacherRepeatType').val();
var wekym2=$('.hidday').val();
var intver=$('#TeacherInterval').val();
if(wekym1=='DAILY' || wekym1=='WEEKLY' || wekym1=='MONTHLY' ||  wekym1=='YEARLY')
   {
      if(wekym1=='WEEKLY')
      { 
         if(wekym2=='' || intver=='0')
          {
            $('.errormsg').show();
            $('.errormsg2').show();
            return false;
          }
         else
          {
            $('.errormsg').hide();
            $('.errormsg2').hide();
            return true;
          }
       
      }
     else
      {
          if(intver=='0' && wekym1 !='WEEKLY')
          {
            $('.errormsg2').show();
            return false;
          }
         else
          {
            $('.errormsg2').hide();
            return true;
          }
      }
     

    
   }
   else
   {
   $('.errormsg2').hide();
   $('.errormsg').hide();
    return true;
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
