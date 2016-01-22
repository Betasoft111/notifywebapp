<script type="text/javascript" src="/attendance/js/main.js"></script>
<link rel="stylesheet" type="text/css" href="/attendance/css/main1.css" />
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
        <li><a href="<?php echo HTTP_ROOT; ?>locations" class="active">Locations</a></li>
        <li><img src="<?php echo HTTP_ROOT; ?>images/arrow.png" alt=""></li>
        <li><a href="<?php echo HTTP_ROOT; ?>locations/view/<?php echo $id; ?>" class="active">Add Employee</a></li>
    </ul>
</div>  
<div class="main_wrapper">
	<?php //echo $this->element('header');?>
	<!--end of header-->
	<section>
		<div class="main_content">
			<div class="outer-cont">
				<!-- <h1>Add/Edit School</h1> -->
				<div class="all_content">
					
						<div class="employees form">
							<?php echo $this->Form->create('Employee',['type' => 'file']); ?>
							
								
								<?php
									echo $this->Form->input('employee_name');
									echo $this->Form->input('email',array('label'=>'Employee Email'));
									echo $this->Form->input('employee_phone');
									echo $this->Form->input('Employee.image', ['type' => 'file']);
									echo $this->Form->submit('Submit',array('class' => 'Submit_button full_width'));
								?>
							
							<?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php echo $this->element('footer');?>
	</div>