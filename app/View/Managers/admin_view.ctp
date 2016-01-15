<div class="managers view">
<h2><?php echo __('Manager'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($manager['Manager']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Userid'); ?></dt>
		<dd>
			<?php echo h($manager['Manager']['userid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Location'); ?></dt>
		<dd>
			<?php echo h($manager['Manager']['location']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Starttime'); ?></dt>
		<dd>
			<?php echo h($manager['Manager']['starttime']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Endtime'); ?></dt>
		<dd>
			<?php echo h($manager['Manager']['endtime']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fromdate'); ?></dt>
		<dd>
			<?php echo h($manager['Manager']['fromdate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Enddate'); ?></dt>
		<dd>
			<?php echo h($manager['Manager']['enddate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Days'); ?></dt>
		<dd>
			<?php echo h($manager['Manager']['days']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('District'); ?></dt>
		<dd>
			<?php echo h($manager['Manager']['district']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Managercode'); ?></dt>
		<dd>
			<?php echo h($manager['Manager']['managercode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Locationcode'); ?></dt>
		<dd>
			<?php echo h($manager['Manager']['locationcode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Companyname'); ?></dt>
		<dd>
			<?php echo h($manager['Manager']['companyname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Latitude'); ?></dt>
		<dd>
			<?php echo h($manager['Manager']['latitude']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Logitude'); ?></dt>
		<dd>
			<?php echo h($manager['Manager']['logitude']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($manager['Manager']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($manager['Manager']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($manager['Manager']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Manager'), array('action' => 'edit', $manager['Manager']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Manager'), array('action' => 'delete', $manager['Manager']['id']), array(), __('Are you sure you want to delete # %s?', $manager['Manager']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Managers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Manager'), array('action' => 'add')); ?> </li>
	</ul>
</div>
