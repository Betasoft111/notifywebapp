<?php echo $this->Html->script('jquery.validate.js')?>
<div id="sub-nav">
	<div class="page-title">
		<h1>Change Password</h1>
	</div>
    <div id="top-buttons">		
        <div id="top-buttons">		
        	<a href="<?php echo HTTP_ROOT.'admin/backends/dashboard'?>" class="btn ui-state-default ui-corner-all">	Back
        	</a>
		</div>
	</div>
</div>
<div id="page-layout">
	<div id="page-content">    	
		<div id="page-content-wrapper" class="no-bg-image wrapper-full">			
			<?php echo $this->Session->flash()?>
			<div class="content-box content-box-header">
				<div class="column-content-box">
					<div class="ui-state-default ui-corner-top ui-box-header">
						<span class="ui-icon float-left ui-icon-notice"></span>
						Please Enter Password.
					</div>
					<div class="content-box-wrapper">
						<form id="form" method="post" action="<?php echo HTTP_ROOT.'admin/backends/change_password/'.@$this->params['pass'][0]?>" >
							<fieldset>
								<ul>
									<li>
										<div>
											<input  name="data[Admin][id]" type="hidden" value="<?php echo $this->Session->read('Admin.id');?>" />
										</div>
									</li>
									<li>
										<label class="desc" >Old Password</label>
										<div>
											<input  class="field text full required" name="data[Admin][old]" type="password" value="" />
										</div>
									</li>
                                	<li>
										<label class="desc" >Password</label>
										<div>
											<input  class="field text full required" id="password" minlength="6" name="data[Admin][new]" type="password" value="" />
										</div>
									</li>
                                 	<li>
										<label class="desc" >Confirm Password</label>
										<div>
											<input  class="field text full required" id="password_again"  name="data[Admin][confirm]" type="password" value="" />
										</div>
									</li>
									<li>
										<input class = "sub-bttn" type="submit" value = "Submit"/>
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
		$('#form').validate({
			 rules: {					
					'data[Admin][confirm]': {
					  equalTo: "#password"
					}
				  }
			});
	});
</script>