<?php // echo $this->Html->script('jquery-1.10.2.min.js')?>
<?php echo $this->Html->script('jquery.validate.js')?>
<?php echo $this->Html->script('admin/ui/ui.datepicker.js')?>
<?php echo $this->Html->script('admin/ui/jquery-ui.js')?>
<?php echo $this->Html->css('ui/ui.datepicker.css');?>
<div id="sub-nav">
	<div class="page-title">
		<h1>Edit Member</h1>
	</div>
	<div id="top-buttons">		
       <a style="margin-bottom:10px;" class="ui-state-default ui-corner-all float-right ui-button" href="javascript:history.go(-1)">Back</a>
	</div>
</div>
<div id="page-layout">
	<div id="page-content">   		
		<div id="page-content-wrapper" class="no-bg-image wrapper-full">			
			<?php echo $this->Session->flash(); ?>			
			<div class="content-box content-box-header">
				<div class="column-content-box">
					<div class="ui-state-default ui-corner-top ui-box-header">
						<span class="ui-icon float-left ui-icon-notice"></span>
						Please Enter Information.
					</div>
					<div class="content-box-wrapper">
						<form name="myform" id="tableFormEdit" class="pager-form" method="post" enctype="multipart/form-data"action="<?php echo HTTP_ROOT.'admin/backends/edit_user'?>">

							<?php echo $this->Form->input('User.id',array('type'=>'hidden','value'=>$user_result['User']['id']));?>
							<fieldset>
								<ul>	   
                        		 	<li>
										<?php echo $this->Form->input('User.fullname',array('div'=>false,'required'=>"required",'label'=>'Fullname','class'=>'full text field','value'=>$user_result['User']['fullname'],'error'=>array('class'=>'error')));?>
								 	</li>
								 	<li>
										<?php echo $this->Form->input('User.username',array('div'=>false,'label'=>'Username','required'=>"required",'readonly'=>'readonly','class'=>'full text field char','value'=>$user_result['User']['username'],'error'=>array('class'=>'error')));?>
									</li>
									<li>
										<?php echo $this->Form->input('User.email',array('div'=>false,'label'=>'Email','required'=>"required",'readonly'=>'readonly','class'=>'full email text field','value'=>$user_result['User']['email'],'error'=>array('class'=>'error')));?>
									</li>
									<li>
										<label for="UserField">User Role</label>
								 		<select name="data[User][role]" id="userRole">
        									<option value="">Choose Role</option>
        									<option <?php if ($user_result['User']['role'] == 1){?> selected="selected"<?php }?> value="1">Student</option>
        									<option <?php if($user_result['User']['role'] == 2){?> selected="selected"<?php }?> value="2">Teacher</option>
									        <option <?php if($user_result['User']['role'] == 3) {?> selected="selected"<?php }?> value="3">Parent</option>	
									    </select>
									</li>
									<li>
										<?php echo $this->Form->submit();?>
									</li>
								</ul>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>
<div class="clear"></div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tableForm').validate(
	  	{
			rules:
			{		
				"data[User][email]":
				{
					required:true,
					email:true,
				},
			},
			messages:
			{
				"data[User][email]":
				{
					required:'This field is required.',
					email:'Please enter valid email address'
				},
				"data[User][zipcode]":
				{
					required:'This field is required.'
				}
				,	
				"data[User][club_image]":
				{
					accept:" accept jpg,jpeg,gif,png,bmp files only"
				}
			}
		});	
	});	
					
</script> 