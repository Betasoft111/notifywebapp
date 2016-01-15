<!doctype html>
<html class="no-js" lang="en">
  <head>
   
    <title>Add/edit Eventee</title>
  
  </head>

  <body>
      <div class="main_wrapper">
      <?php echo $this->element('header');?>
<!--end of header-->
<section>
<div class="main_content">
<div class="row Heading">
<h1>Add/edit Eventee</h1>
<div class="all_content">
<h6><a href="<?php echo HTTP_ROOT."event/eventeeView/".@$eventid; ?>">List</a></h6>
<br/>
<div class="large-6 large-centered medium-6 medium-centered small-12 columns">
<?php echo $this->Form->create('Eventee',array('enctype'=>'multipart/form-data')); ?>
<label>Event Code<span class="star">*</span></label>
<?php echo $this->Form->input('id',array('label'=>false, 'type'=>'hidden','value'=>@$eventeedata['Eventee']['id'])); ?>
<?php echo $this->Form->input('event_id',array('label'=>false, 'type'=>'hidden','value'=>@$eventid)); ?>
<?php echo $this->Form->input('eventCode',array('label'=>false,'value'=>@$eventCode,'readonly'=>true)); ?>
<label>Eventee Email<span class="star">*</span></label>
<?php echo $this->Form->input('eventee_email',array('label'=>false, 'value'=>@$eventeedata['Eventee']['eventee_email'])); ?>
<label>Parent Email</label>
<?php echo $this->Form->input('parent_email',array('label'=>false, 'value'=>@$eventeedata['Eventee']['parent_email'])); ?>
<label>Eventee Image</label>
<?php echo $this->Form->input('old_image',array('label'=>false, 'type'=>'hidden','value'=>@$eventeedata['Eventee']['image'])); ?>
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
