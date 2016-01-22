<script type="text/javascript" src="/attendance/js/main.js"></script>
<link rel="stylesheet" type="text/css" href="/attendance/css/main1.css" />
<div class="top-cont">
  <div class="top-left"><a href="<?php echo HTTP_ROOT;?>"><img src="<?php echo HTTP_ROOT;?>images/notify-img.png" alt=""></a></div>
  <div class="top-right"><a href="<?php echo HTTP_ROOT."users/profile"; ?>"><img style="width:25px;height:25px;border-radius:10px;" id="profilepic" src="<?php if($parentData['User']['profile_pic']!=''){echo HTTP_ROOT.'bss_files/'.$parentData['User']['profile_pic'];}else{ echo HTTP_ROOT.'img/images/Profile-pic.png'; }?>"> <?php echo $parentData['User']['first_name']!=''?@$parentData['User']['first_name']:'--------------';  ?> <?php echo $parentData['User']['last_name']!=''?@$parentData['User']['last_name']:'---------------';  ?></a></div>
  <h2>Management</h2>
</div>

<div class="bread-crumb">
    <ul>
        <li><a href="<?php echo HTTP_ROOT;?>management">Home</a></li>
        <li><img src="<?php echo HTTP_ROOT;?>images/arrow.png" alt=""></li>
        <li><a href="<?php echo HTTP_ROOT;?>management" class="active">Management</a></li>
        <li><img src="<?php echo HTTP_ROOT;?>images/arrow.png" alt=""></li>
        <li><a href="<?php echo HTTP_ROOT;?>locations/view/<?php echo $locationid; ?>" class="active">Location</a></li>
        <li><img src="<?php echo HTTP_ROOT;?>images/arrow.png" alt=""></li>
        <li><a href="<?php echo HTTP_ROOT;?>locations/employees/<?php echo $locationid; ?>" class="active">Employee List</a></li>
        <li><img src="<?php echo HTTP_ROOT;?>images/arrow.png" alt=""></li>
        <li><a href="<?php echo HTTP_ROOT;?>locations/employeesview/<?php echo $locationid; ?>/<?php echo $empid; ?>" class="active">Employee</a></li>
        <li><img src="<?php echo HTTP_ROOT;?>images/arrow.png" alt=""></li>
        <li><a href="javascript:void(0)" class="active">Update Details</a></li>
    </ul>
</div>  

<div class="main_wrapper">
  <?php //echo $this->element('header');?>
  <!--end of header-->
  <section>
    <div class="main_content">
      <div class="outer-cont">
       <!--  <h1>Add/Edit School</h1> -->
        <div class="all_content">
         <!--  <h6><a href="<?php echo HTTP_ROOT."management/employlist"; ?>">List</a></h6>
          <br/> -->
          <div class="">
            <div class="employees form">
              <?php echo $this->Form->create('Employee',['type' => 'file']); ?>
              
                
                <?php
                echo $this->Form->input('id',array('label'=>false, 'type'=>'hidden','value'=>@$employee['Employee']['id']));
                  echo $this->Form->input('employee_name',array('value'=>@$employee['Employee']['employee_name']));
                  echo $this->Form->input('employee_email',array('label'=>'Employee Email','value'=>@$employee['Employee']['employee_email']));
                  echo $this->Form->input('parent_email',array('value'=>@$employee['Employee']['parent_email']));
                  ?>
                  <div class="employee-image-cont">
      <div class="school_image img">
      <img id="profilepic" src="
  <?php if($employee['Employee']['image']!=''){
    echo HTTP_ROOT.'bss_files/'.$employee['Employee']['image'];
}
  else{ 
    echo '';
     }?>">
      </div></div>

                  <?php
                  echo $this->Form->input('Employee.image', ['type' => 'file']);
                  echo $this->Form->submit('Submit',array('class' => 'Submit_button full_width'));
                ?>
             
              <a href="<?php echo HTTP_ROOT; ?>locations/employeesview/<?php echo $locationid; ?>/<?php echo $empid; ?>">Cancel</a>
              <?php echo $this->Form->end(); ?>
            </div></div>
          </div>
        </div>
      </div>
    </section>
    <?php echo $this->element('footer');?>
  </div>