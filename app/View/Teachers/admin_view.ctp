<div class="teachers view">
<h2><?php echo __('Teacher'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($teacher['Teacher']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Userid'); ?></dt>
		<dd>
			<?php echo h($teacher['Teacher']['userid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Classname'); ?></dt>
		<dd>
			<?php echo h($teacher['Teacher']['classname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Starttime'); ?></dt>
		<dd>
			<?php echo h($teacher['Teacher']['starttime']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Endtime'); ?></dt>
		<dd>
			<?php echo h($teacher['Teacher']['endtime']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fromdate'); ?></dt>
		<dd>
			<?php echo h($teacher['Teacher']['fromdate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Enddate'); ?></dt>
		<dd>
			<?php echo h($teacher['Teacher']['enddate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Days'); ?></dt>
		<dd>
			<?php echo h($teacher['Teacher']['days']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('District'); ?></dt>
		<dd>
			<?php echo h($teacher['Teacher']['district']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($teacher['Teacher']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Latitude'); ?></dt>
		<dd>
			<?php echo h($teacher['Teacher']['latitude']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Logitude'); ?></dt>
		<dd>
			<?php echo h($teacher['Teacher']['logitude']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($teacher['Teacher']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($teacher['Teacher']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($teacher['Teacher']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Teacher'), array('action' => 'edit', $teacher['Teacher']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Teacher'), array('action' => 'delete', $teacher['Teacher']['id']), array(), __('Are you sure you want to delete # %s?', $teacher['Teacher']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Teachers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Teacher'), array('action' => 'add')); ?> </li>
	</ul>
</div>
