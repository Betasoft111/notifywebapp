<style>
.input.time > select {
width: 32.5%;
}
.input.date > select {
width: 32.5%;
}
.first {
float: left;
margin-right: 10px;
}
</style>
 <div class="top-cont">
  <div class="top-left"><a href="<?php echo HTTP_ROOT;?>"><img src="<?php echo HTTP_ROOT;?>images/notify-img.png" alt=""></a></div>
  <div class="top-right"><a href="<?php echo HTTP_ROOT."users/profile"; ?>"><img style="width:25px;height:25px;border-radius:10px;" id="profilepic" src="<?php if($parentData['User']['profile_pic']!=''){echo HTTP_ROOT.'bss_files/'.$parentData['User']['profile_pic'];}else{ echo HTTP_ROOT.'img/images/Profile-pic.png'; }?>"> <?php echo $parentData['User']['first_name']!=''?@$parentData['User']['first_name']:'--------------';  ?> <?php echo $parentData['User']['last_name']!=''?@$parentData['User']['last_name']:'---------------';  ?></a></div>
  <h2>Healthcare</h2>
</div>

<div class="bread-crumb">
    <ul>
        <li><a href="<?php echo HTTP_ROOT; ?>management">Home</a></li>
        <li><img src="<?php echo HTTP_ROOT; ?>images/arrow.png" alt=""></li>
        <li><a href="<?php echo HTTP_ROOT; ?>management" class="active">Healthcare</a></li>
        <li><img src="<?php echo HTTP_ROOT; ?>images/arrow.png" alt=""></li>
        <li><a href="<?php echo HTTP_ROOT; ?>locations/view/<?php echo $id; ?>" class="active">Location</a></li>
        <li><img src="<?php echo HTTP_ROOT; ?>images/arrow.png" alt=""></li>
        <li><a href="javascript:void(0)" class="active">Schedule</a></li>
    </ul>
</div> 
<div class="main_wrapper">
  <?php //echo $this->element('header'); ?>
  <!--end of header-->
  <section>
    <div class="main_content">
      <div class="row Heading">
        <!-- <h1>Add/Edit Meeting</h1> -->
        <div class="all_content">
          <!-- <div class="large-12 columns">
            <h6><a href="<?php echo HTTP_ROOT."management/Meetinglist"; ?>">Listing</a></h6>
          </div> -->
          <div class="large-6 large-centered medium-6 medium-centered small-12 columns">
            <?php echo $this->Form->create('EmployeeSchedule'); ?>
            <label>Employee Name<span class="star">*</span></label>
            <?php echo $this->Form->input('id',array('label'=>false, 'type'=>'hidden','value'=>@$employee['Employee']['id'])); ?>
            <?php
            $sizes=array(''=>'Select');
            foreach ($employee as $key => $value) {
            //$array= $value['Employee']['id'] => $value['Employee']['employee_name'];
            $sizes[$value['Employee']['id']] = $value['Employee']['employee_name'];
            }
            
            echo $this->Form->input(
            'employ_id',
            array('options' => $sizes, 'default' => 'Select','label'=>false ,'value'=>@$employee['Employee']['users'])
            );
            ?>
            <label>Schedule On<span class="star">*</span></label>
            <?php $sizes = array(''=>'Select','DAILY' => 'DAILY', 'MON_TO_FRI' => 'MON_TO_FRI', 'MON_WED_FRI' => 'MON_WED_FRI','TUE_THR'=>'TUE_THR','WEEKLY'=>'WEEKLY','MONTHLY'=>'MONTHLY','YEARLY'=>'YEARLY');
            echo $this->Form->input(
            'scheduletime',
            array('options' => $sizes, 'default' => 'Select','label'=>false ,'value'=>@$companydata['Company']['repeatType'])
            );
            ?>
            <label>Start Time<span class="star">*</span></label>
            <?php echo $this->Form->input('meeting_start_time',array('label'=>false, 'placeholder'=>'Start time','value'=>date("g:i a",strtotime(@$employee['Employee']['meeting_start_time'])))); ?>
            <label>End Time<span class="star">*</span></label>
            <?php echo $this->Form->input('meeting_end_time',array('label'=>false, 'placeholder'=>'End time','value'=>date("g:i a",strtotime(@$employee['Employee']['meeting_end_time'])))); ?>
            <label>Start Date<span class="star">*</span></label>
            <?php echo $this->Form->input('startDate',array('label'=>false, 'placeholder'=>'Start Date','value'=>@$classdata['Teacher']['startDate'])); ?>
            <label>End Date<span class="star">*</span></label>
            <?php echo $this->Form->input('endDate',array('label'=>false, 'placeholder'=>'End Date','value'=>@$classdata['Teacher']['endDate'])); ?>
            <a href="<?php echo HTTP_ROOT; ?>locations/view/<?php echo $id; ?>">Back</a>
            <?php echo $this->Form->end(array('class'=>'Submit_button full_width','label'=>'Submit')); ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php echo $this->element('footer'); ?>
</div>
