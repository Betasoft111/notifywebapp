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
<h1>Add/Edit Child</h1>
<div class="all_content">
<h6><a href="<?php echo HTTP_ROOT."school/childList"; ?>">List</a></h6>
<br/>
<div class="large-6 large-centered medium-6 medium-centered small-12 columns">
<?php echo $this->Form->create('Children'); ?>
<label>Child name<span class="star">*</span></label>
<?php echo $this->Form->input('id',array('label'=>false, 'type'=>'hidden','value'=>@$studentdata['Children']['id'])); ?>
<?php echo $this->Form->input('mainstu_id',array('label'=>false, 'type'=>'hidden','value'=>@$studentdata['Children']['mainstu_id'])); ?>
<?php echo $this->Form->input('student_id',array('label'=>false, 'type'=>'hidden','value'=>@$studentdata['Children']['student_id'])); ?>
<?php echo $this->Form->input('child_name',array('label'=>false,'value'=>@$studentdata['Children']['child_name'])); ?>
<label>Child Code<span class="star">*</span></label>
<?php echo $this->Form->input('code',array('label'=>false, 'value'=>@$studentdata['Children']['code'])); ?>
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
<script>
$(document).ready(function(){
var valid=$('#ChildrenId').val();
if(valid !='')
{
$('#ChildrenCode').attr('readonly',true);
}
else
{
$('#ChildrenCode').attr('readonly',false);
}
});
</script>
