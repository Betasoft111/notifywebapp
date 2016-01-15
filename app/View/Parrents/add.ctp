<div class="parrents form">
<?php echo $this->Form->create('Parrent'); ?>
	<fieldset>
		<legend><?php echo __('Add Parrent'); ?></legend>
	<?php
		echo $this->Form->input('userid');
		echo $this->Form->input('childname');
		echo $this->Form->input('teachercode');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Parrents'), array('action' => 'index')); ?></li>
	</ul>
</div>
