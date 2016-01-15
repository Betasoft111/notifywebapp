<!doctype html>
<html class="no-js" lang="en">
  <head>
   
    <title>Add District</title>
  
  </head>

  <body>
      <div class="main_wrapper">
      <?php echo $this->element('header');?>
<!--end of header-->
<section>
<div class="main_content">
<div class="row Heading">
<h1>Add/Edit District</h1>
<div class="all_content">
<h6><a href="<?php echo HTTP_ROOT."school/districtList"; ?>">List</a></h6>
<br/>
<div class="large-6 large-centered medium-6 medium-centered small-12 columns">
<?php echo $this->Form->create('District'); ?>
<label>District Name<span class="star">*</span></label>
<?php echo $this->Form->input('id',array('label'=>false, 'type'=>'hidden','value'=>@$districtdata['District']['id'])); ?>
<?php echo $this->Form->input('district_name',array('label'=>false, 'value'=>@$districtdata['District']['district_name'])); ?>
<label>District Email<span class="star">*</span></label>
<?php echo $this->Form->input('email',array('label'=>false,'value'=>@$districtdata['District']['email'])); ?>
<label class="District_textarea">District Description<span class="star">*</span></label>
<?php echo $this->Form->input('description',array('label'=>false, 'type'=>'textarea','row'=>'5','value'=>@$districtdata['District']['description'])); ?>
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
