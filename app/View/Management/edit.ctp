<div class="main_wrapper">
  <?php echo $this->element('header');?>
  <!--end of header-->
  <section>
    <div class="main_content">
      <div class="row Heading">
        <h1>Add/Edit School</h1>
        <div class="all_content">
          <h6><a href="<?php echo HTTP_ROOT."management/employlist"; ?>">List</a></h6>
          <br/>
          <div class="large-6 large-centered medium-6 medium-centered small-12 columns">
            <div class="employees form">
              <?php echo $this->Form->create('Employee',['type' => 'file']); ?>
              <fieldset>
                <legend><?php echo __('Add Employee'); ?></legend>
                <?php
                echo $this->Form->input('id',array('label'=>false, 'type'=>'hidden','value'=>@$employee['Employee']['id']));
                  echo $this->Form->input('employee_name',array('value'=>@$employee['Employee']['employee_name']));
                  echo $this->Form->input('email',array('label'=>'Employee Email','value'=>@$employee['Employee']['employee_email']));
                  echo $this->Form->input('employee_phone',array('value'=>@$employee['Employee']['employee_phone']));
                  ?>
                  <div class="large-4 columns">
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
              </fieldset>
              <?php echo $this->Form->end(); ?>
            </div></div>
          </div>
        </div>
      </div>
    </section>
    <?php echo $this->element('footer');?>
  </div>