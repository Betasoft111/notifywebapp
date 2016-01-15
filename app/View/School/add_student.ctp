<!doctype html>
<html class="no-js" lang="en">
  <head>
   
    <title>Add/edit Student</title>
  
  </head>

  <body>
      <div class="main_wrapper">
      <?php echo $this->element('header');?>
<!--end of header-->
<section>
<div class="main_content">
<div class="row Heading">
<h1>Add/Edit Student</h1>
<div class="all_content">
<h6><a href="<?php echo HTTP_ROOT."school/studentView/".@$classid; ?>">List</a></h6>
<br/>
<div class="large-6 large-centered medium-6 medium-centered small-12 columns">
<?php echo $this->Form->create('Student',array('enctype'=>'multipart/form-data')); ?>
<label>Class Code<span class="star">*</span></label>
<?php echo $this->Form->input('id',array('label'=>false, 'type'=>'hidden','value'=>@$studentdata['Student']['id'])); ?>
<?php echo $this->Form->input('teacher_id',array('label'=>false, 'type'=>'hidden','value'=>@$classid)); ?>
<?php echo $this->Form->input('classCode',array('label'=>false,'value'=>@$classCode,'readonly'=>true)); ?>
<label>Student Email<span class="star">*</span></label>
<?php echo $this->Form->input('student_email',array('label'=>false, 'value'=>@$studentdata['Student']['student_email'])); ?>
<label>Parent Email</label>
<?php echo $this->Form->input('parent_email',array('label'=>false, 'value'=>@$studentdata['Student']['parent_email'])); ?>
<label>Student Image</label>
<?php echo $this->Form->input('old_image',array('label'=>false, 'type'=>'hidden','value'=>@$studentdata['Student']['image'])); ?>
<?php echo $this->Form->input('new_image',array('label'=>false,'type'=>'file')); ?>
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
