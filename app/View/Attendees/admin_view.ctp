<div class="attendees view">
<h2><?php echo __('Attendee'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($attendee['Attendee']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Userid'); ?></dt>
		<dd>
			<?php echo h($attendee['Attendee']['userid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Eventname'); ?></dt>
		<dd>
			<?php echo h($attendee['Attendee']['eventname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($attendee['Attendee']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($attendee['Attendee']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($attendee['Attendee']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Attendee'), array('action' => 'edit', $attendee['Attendee']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Attendee'), array('action' => 'delete', $attendee['Attendee']['id']), array(), __('Are you sure you want to delete # %s?', $attendee['Attendee']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Attendees'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attendee'), array('action' => 'add')); ?> </li>
	</ul>
</div>
