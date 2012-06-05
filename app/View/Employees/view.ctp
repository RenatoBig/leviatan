<div class="employees view">
<h2><?php  echo __('Employee');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Registration'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['registration']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Birth Date'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['birth_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rg'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['rg']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cpf'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['cpf']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Voter Card'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['voter_card']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ctps'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['ctps']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Reservist'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['reservist']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Agency'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['agency']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Account'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['account']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unity Sector'); ?></dt>
		<dd>
			<?php echo $this->Html->link($employee['UnitySector']['id'], array('controller' => 'unity_sectors', 'action' => 'view', $employee['UnitySector']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Employee'), array('action' => 'edit', $employee['Employee']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Employee'), array('action' => 'delete', $employee['Employee']['id']), null, __('Are you sure you want to delete # %s?', $employee['Employee']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Employees'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Employee'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Unity Sectors'), array('controller' => 'unity_sectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unity Sector'), array('controller' => 'unity_sectors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Users');?></h3>
	<?php if (!empty($employee['User'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Employee Id'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Group Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($employee['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id'];?></td>
			<td><?php echo $user['employee_id'];?></td>
			<td><?php echo $user['username'];?></td>
			<td><?php echo $user['password'];?></td>
			<td><?php echo $user['group_id'];?></td>
			<td><?php echo $user['created'];?></td>
			<td><?php echo $user['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), null, __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
