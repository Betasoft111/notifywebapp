<div class="teachers index">
	<h2><?php echo __('Teachers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('userid'); ?></th>
			<th><?php echo $this->Paginator->sort('classname'); ?></th>
			<th><?php echo $this->Paginator->sort('starttime'); ?></th>
			<th><?php echo $this->Paginator->sort('endtime'); ?></th>
			<th><?php echo $this->Paginator->sort('fromdate'); ?></th>
			<th><?php echo $this->Paginator->sort('enddate'); ?></th>
			<th><?php echo $this->Paginator->sort('days'); ?></th>
			<th><?php echo $this->Paginator->sort('district'); ?></th>
			<th><?php echo $this->Paginator->sort('code'); ?></th>
			<th><?php echo $this->Paginator->sort('latitude'); ?></th>
			<th><?php echo $this->Paginator->sort('logitude'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($teachers as $teacher): ?>
	<tr>
		<td><?php echo h($teacher['Teacher']['id']); ?>&nbsp;</td>
		<td><?php echo h($teacher['Teacher']['userid']); ?>&nbsp;</td>
		<td><?php echo h($teacher['Teacher']['classname']); ?>&nbsp;</td>
		<td><?php echo h($teacher['Teacher']['starttime']); ?>&nbsp;</td>
		<td><?php echo h($teacher['Teacher']['endtime']); ?>&nbsp;</td>
		<td><?php echo h($teacher['Teacher']['fromdate']); ?>&nbsp;</td>
		<td><?php echo h($teacher['Teacher']['enddate']); ?>&nbsp;</td>
		<td><?php echo h($teacher['Teacher']['days']); ?>&nbsp;</td>
		<td><?php echo h($teacher['Teacher']['district']); ?>&nbsp;</td>
		<td><?php echo h($teacher['Teacher']['code']); ?>&nbsp;</td>
		<td><?php echo h($teacher['Teacher']['latitude']); ?>&nbsp;</td>
		<td><?php echo h($teacher['Teacher']['logitude']); ?>&nbsp;</td>
		<td><?php echo h($teacher['Teacher']['status']); ?>&nbsp;</td>
		<td><?php echo h($teacher['Teacher']['created']); ?>&nbsp;</td>
		<td><?php echo h($teacher['Teacher']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $teacher['Teacher']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $teacher['Teacher']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $teacher['Teacher']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $teacher['Teacher']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Teacher'), array('action' => 'add')); ?></li>
	</ul>
</div>
