<div class="managers index">
	<h2><?php echo __('Managers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('userid'); ?></th>
			<th><?php echo $this->Paginator->sort('location'); ?></th>
			<th><?php echo $this->Paginator->sort('starttime'); ?></th>
			<th><?php echo $this->Paginator->sort('endtime'); ?></th>
			<th><?php echo $this->Paginator->sort('fromdate'); ?></th>
			<th><?php echo $this->Paginator->sort('enddate'); ?></th>
			<th><?php echo $this->Paginator->sort('days'); ?></th>
			<th><?php echo $this->Paginator->sort('district'); ?></th>
			<th><?php echo $this->Paginator->sort('managercode'); ?></th>
			<th><?php echo $this->Paginator->sort('locationcode'); ?></th>
			<th><?php echo $this->Paginator->sort('companyname'); ?></th>
			<th><?php echo $this->Paginator->sort('latitude'); ?></th>
			<th><?php echo $this->Paginator->sort('logitude'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($managers as $manager): ?>
	<tr>
		<td><?php echo h($manager['Manager']['id']); ?>&nbsp;</td>
		<td><?php echo h($manager['Manager']['userid']); ?>&nbsp;</td>
		<td><?php echo h($manager['Manager']['location']); ?>&nbsp;</td>
		<td><?php echo h($manager['Manager']['starttime']); ?>&nbsp;</td>
		<td><?php echo h($manager['Manager']['endtime']); ?>&nbsp;</td>
		<td><?php echo h($manager['Manager']['fromdate']); ?>&nbsp;</td>
		<td><?php echo h($manager['Manager']['enddate']); ?>&nbsp;</td>
		<td><?php echo h($manager['Manager']['days']); ?>&nbsp;</td>
		<td><?php echo h($manager['Manager']['district']); ?>&nbsp;</td>
		<td><?php echo h($manager['Manager']['managercode']); ?>&nbsp;</td>
		<td><?php echo h($manager['Manager']['locationcode']); ?>&nbsp;</td>
		<td><?php echo h($manager['Manager']['companyname']); ?>&nbsp;</td>
		<td><?php echo h($manager['Manager']['latitude']); ?>&nbsp;</td>
		<td><?php echo h($manager['Manager']['logitude']); ?>&nbsp;</td>
		<td><?php echo h($manager['Manager']['status']); ?>&nbsp;</td>
		<td><?php echo h($manager['Manager']['created']); ?>&nbsp;</td>
		<td><?php echo h($manager['Manager']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $manager['Manager']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $manager['Manager']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $manager['Manager']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $manager['Manager']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Manager'), array('action' => 'add')); ?></li>
	</ul>
</div>
