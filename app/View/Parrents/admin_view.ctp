<div class="parrents view">
<h2><?php echo __('Parrent'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($parrent['Parrent']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Userid'); ?></dt>
		<dd>
			<?php echo h($parrent['Parrent']['userid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Childname'); ?></dt>
		<dd>
			<?php echo h($parrent['Parrent']['childname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Teachercode'); ?></dt>
		<dd>
			<?php echo h($parrent['Parrent']['teachercode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($parrent['Parrent']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($parrent['Parrent']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($parrent['Parrent']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Parrent'), array('action' => 'edit', $parrent['Parrent']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Parrent'), array('action' => 'delete', $parrent['Parrent']['id']), array(), __('Are you sure you want to delete # %s?', $parrent['Parrent']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Parrents'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parrent'), array('action' => 'add')); ?> </li>
	</ul>
</div>
