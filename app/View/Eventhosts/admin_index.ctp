<div class="eventhosts index">
	<h2><?php echo __('Eventhosts'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('userid'); ?></th>
			<th><?php echo $this->Paginator->sort('eventname'); ?></th>
			<th><?php echo $this->Paginator->sort('starttime'); ?></th>
			<th><?php echo $this->Paginator->sort('endtime'); ?></th>
			<th><?php echo $this->Paginator->sort('fromdate'); ?></th>
			<th><?php echo $this->Paginator->sort('enddate'); ?></th>
			<th><?php echo $this->Paginator->sort('days'); ?></th>
			<th><?php echo $this->Paginator->sort('district'); ?></th>
			<th><?php echo $this->Paginator->sort('code'); ?></th>
			<th><?php echo $this->Paginator->sort('companycode'); ?></th>
			<th><?php echo $this->Paginator->sort('latitude'); ?></th>
			<th><?php echo $this->Paginator->sort('logitude'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($eventhosts as $eventhost): ?>
	<tr>
		<td><?php echo h($eventhost['Eventhost']['id']); ?>&nbsp;</td>
		<td><?php echo h($eventhost['Eventhost']['userid']); ?>&nbsp;</td>
		<td><?php echo h($eventhost['Eventhost']['eventname']); ?>&nbsp;</td>
		<td><?php echo h($eventhost['Eventhost']['starttime']); ?>&nbsp;</td>
		<td><?php echo h($eventhost['Eventhost']['endtime']); ?>&nbsp;</td>
		<td><?php echo h($eventhost['Eventhost']['fromdate']); ?>&nbsp;</td>
		<td><?php echo h($eventhost['Eventhost']['enddate']); ?>&nbsp;</td>
		<td><?php echo h($eventhost['Eventhost']['days']); ?>&nbsp;</td>
		<td><?php echo h($eventhost['Eventhost']['district']); ?>&nbsp;</td>
		<td><?php echo h($eventhost['Eventhost']['code']); ?>&nbsp;</td>
		<td><?php echo h($eventhost['Eventhost']['companycode']); ?>&nbsp;</td>
		<td><?php echo h($eventhost['Eventhost']['latitude']); ?>&nbsp;</td>
		<td><?php echo h($eventhost['Eventhost']['logitude']); ?>&nbsp;</td>
		<td><?php echo h($eventhost['Eventhost']['status']); ?>&nbsp;</td>
		<td><?php echo h($eventhost['Eventhost']['created']); ?>&nbsp;</td>
		<td><?php echo h($eventhost['Eventhost']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $eventhost['Eventhost']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $eventhost['Eventhost']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $eventhost['Eventhost']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $eventhost['Eventhost']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Eventhost'), array('action' => 'add')); ?></li>
	</ul>
</div>
