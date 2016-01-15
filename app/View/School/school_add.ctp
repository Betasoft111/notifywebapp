<!doctype html>
<html class="no-js" lang="en">
  <head>
   
    <title>Add School</title>
  
  </head>

  <body>
      <div class="main_wrapper">
      <?php echo $this->element('header');?>
<!--end of header-->
<section>
<div class="main_content">
<div class="row Heading">
<h1>Add/Edit School</h1>
<div class="all_content">
<h6><a href="<?php echo HTTP_ROOT."school/schoolList"; ?>">List</a></h6>
<br/>
<div class="large-6 large-centered medium-6 medium-centered small-12 columns">
<?php echo $this->Form->create('School'); ?>
<label>District Code</label>
<?php echo $this->Form->input('id',array('label'=>false, 'type'=>'hidden','value'=>@$schooldata['School']['id'])); ?>
<?php echo $this->Form->input('district_code',array('label'=>false, 'value'=>@$schooldata['School']['district_code'])); ?>
<label>School Name<span class="star">*</span></label>
<?php echo $this->Form->input('school_name',array('label'=>false, 'value'=>@$schooldata['School']['school_name'])); ?>
<label>School Email<span class="star">*</span></label>
<?php echo $this->Form->input('email',array('label'=>false,'value'=>@$schooldata['School']['email'])); ?>
<label class="District_textarea">School Address<span class="star">*</span></label>
<?php echo $this->Form->input('address',array('label'=>false, 'type'=>'textarea','row'=>'5','value'=>@$schooldata['School']['address'])); ?>
<?php echo $this->Form->end(array('class'=>'Submit_button full_width','label'=>'Submit')); ?>
</div>

</div>

</div>
  </div>
</section>
<?php echo $this->element('footer');?>
      </div>
  </body>
</html>
