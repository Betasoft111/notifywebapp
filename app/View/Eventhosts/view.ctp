<div class="eventhosts view">
<h2><?php echo __('Eventhost'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($eventhost['Eventhost']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Userid'); ?></dt>
		<dd>
			<?php echo h($eventhost['Eventhost']['userid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Eventname'); ?></dt>
		<dd>
			<?php echo h($eventhost['Eventhost']['eventname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Starttime'); ?></dt>
		<dd>
			<?php echo h($eventhost['Eventhost']['starttime']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Endtime'); ?></dt>
		<dd>
			<?php echo h($eventhost['Eventhost']['endtime']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fromdate'); ?></dt>
		<dd>
			<?php echo h($eventhost['Eventhost']['fromdate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Enddate'); ?></dt>
		<dd>
			<?php echo h($eventhost['Eventhost']['enddate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Days'); ?></dt>
		<dd>
			<?php echo h($eventhost['Eventhost']['days']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('District'); ?></dt>
		<dd>
			<?php echo h($eventhost['Eventhost']['district']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($eventhost['Eventhost']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Companycode'); ?></dt>
		<dd>
			<?php echo h($eventhost['Eventhost']['companycode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Latitude'); ?></dt>
		<dd>
			<?php echo h($eventhost['Eventhost']['latitude']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Logitude'); ?></dt>
		<dd>
			<?php echo h($eventhost['Eventhost']['logitude']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($eventhost['Eventhost']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($eventhost['Eventhost']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($eventhost['Eventhost']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Eventhost'), array('action' => 'edit', $eventhost['Eventhost']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Eventhost'), array('action' => 'delete', $eventhost['Eventhost']['id']), array(), __('Are you sure you want to delete # %s?', $eventhost['Eventhost']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Eventhosts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Eventhost'), array('action' => 'add')); ?> </li>
	</ul>
</div>
