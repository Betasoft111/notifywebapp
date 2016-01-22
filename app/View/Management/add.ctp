<div class="main_wrapper">
	<?php echo $this->element('header');?>
	<!--end of header-->
	<section>
		<div class="main_content">
			
				<div class="outer-cont">
				<div class="all_content">
					<h6><a href="<?php echo HTTP_ROOT."management/employlist"; ?>">List</a></h6>				
					<div class="add-inner-cont">
						<div class="employees form">
							<?php echo $this->Form->create('Employee',['type' => 'file']); ?>
							<fieldset>
								<legend><?php echo __('Add Employee'); ?></legend>
								<?php
									echo $this->Form->input('employee_name');
									echo $this->Form->input('email',array('label'=>'Employee Email'));
									echo $this->Form->input('employee_phone');
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