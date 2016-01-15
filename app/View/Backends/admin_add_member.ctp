<?php echo $this->Html->script('admin/jquery.validate.js')?>
<?php echo $this->Html->script('admin/ui/ui.datepicker.js')?>
<?php echo $this->Html->script('admin/ui/jquery-ui.js')?>
<?php  echo $this->Html->css('ui/ui.datepicker.css');?>
<div id="sub-nav">
	<div class="page-title">
		<h1>Add Member</h1>
	</div>
	<div id="top-buttons">		
        <a href="<?php echo HTTP_ROOT.'admin/backends/manageMenber'?>" class="btn ui-state-default ui-corner-all">Back</a>
	</div>
</div>
<div id="page-layout">
	<div id="page-content">   		
		<div id="page-content-wrapper" class="no-bg-image wrapper-full">
			<div class="content-box content-box-header">
				<div class="column-content-box">
					<div class="ui-state-default ui-corner-top ui-box-header">
						<span class="ui-icon float-left ui-icon-notice"></span>
						Please Enter Information.
					</div>
					<div class="content-box-wrapper">
						<form name="myform" id="tableForm" class="pager-form" method="post" enctype="multipart/form-data"action="<?php echo HTTP_ROOT.'admin/backends/add_member'?>">
							<fieldset>
								<ul>
									<li>
										<?php echo $this->Form->input('User.username',array('div'=>false,'label'=>'Username','required'=>false,'id'=>'UserUname','class'=>'full text field char','error'=>array('class'=>'error')));?>
										<div id="reguser" style="display:none; color:red;">
											This User  Already exists
										</div>
									</li>
									<li>
										<?php echo $this->Form->input('User.fullname',array('div'=>false, 'label'=>'Fullname','required'=>false,'class'=>'full name text field','error'=>array('class'=>'error')))?>
									</li>
			            			<li>
										<?php echo $this->Form->input('User.email',array('div'=>false,'label'=>'Email','required'=>false,'id'=>'userEmail','class'=>'full email text field','error'=>array('class'=>'error')));?>
										<div id="regEmail" style="display:none; color:red;">
											This Email is Already Registered
										</div>
									</li>
									<li>
										<?php echo $this->Form->input('User.password',array('div'=>false, 'label'=>'Password','required'=>false,'class'=>'full password text field','error'=>array('class'=>'error')))?>
									</li>
								 	<li>
								 		<label for="UserField">User Role</label>
								 		<select name="data[User][role]" id="userRole">
        									<option value="">Choose Role</option>
        									<option value="1">Student</option>
        									<option value="2">Teacher</option>
									        <option value="3">Parent</option>	
									    </select>
								 	</li>
									<li>
										<?php echo $this->Form->submit('Submit',array('id'=>'btn-submit'));?>
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

	jQuery(document).ready(function($){
		var abc="";
  		$('#UserUname').blur(function(){
    		var userName = $(this).val();
    		$.ajax({
      			type:"POST",
      			data: ({ 'uname' : userName }),
      			url:ajax_url+"admin/backends/uname_check",
      			success: function (response) {
					if(response == 'true')
					{
						$('#reguser').show();
						abc ='noAllow'
					}
					if(response == 'false')
					{
						$('#reguser').hide();
						abc = 'allow'
					}
      			}
   			 });
  		});
  		$('#userEmail').blur(function(){
    		var userEmai = $(this).val();
    		$.ajax({
      			type:"POST",
      			data: ({ 'uemail' : userEmai }),
      			url:ajax_url+"admin/backends/uemail_check",
      			success: function (response) {
					if(response == 'true')
					{
						$('#regEmail').show();
						abc ='noAllow'
					}
					if(response == 'false')
					{
						$('#regEmail').hide();
						abc = 'allow'
					}
      			}
   			 });
  		});
  		$("#btn-submit").on('click', function(){
  			$("form").validate();
			if(abc=='noAllow')
			{
				return false;
			}
			if(abc == 'allow')
			{
				return true;
			}
		});
	
 
  /* $("#tableForm").validate({
		rules: {
			"User.fullname": "required",
			"data[User][username]": {
				required: true,
				minlength: 2
			},
			"data[User][password]": {
				required: true,
				minlength: 6
			},
			"data[User][email]": {
				required: true,
				email: true
			},
		},
			messages: {
				"User.fullname": "Please enter your firstname",
				"data[User][username]": {
					required: "Please enter a username",
					minlength: "Your username must consist of at least 2 characters"
				},
				"data[User][password]": {
					required: "Please provide a password",
					minlength: "Your password must be at least 6 characters long"
				},
				"data[User][email]": {
					required: "Please enter a valid email address"
				}
			}
		});*/
   });
</script>
<style>
#tableForm fieldset label.error {
    color: #FB3A3A;
    display: inline-block;
    margin: 4px 0 5px 125px;
    padding: 0;
    text-align: left;
    width: 220px;
}
</style>