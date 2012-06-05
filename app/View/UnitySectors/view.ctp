<div class="unitySectors view">
<h2><?php  echo __('Unity Sector');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($unitySector['UnitySector']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unity'); ?></dt>
		<dd>
			<?php echo $this->Html->link($unitySector['Unity']['name'], array('controller' => 'unities', 'action' => 'view', $unitySector['Unity']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sector'); ?></dt>
		<dd>
			<?php echo $this->Html->link($unitySector['Sector']['name'], array('controller' => 'sectors', 'action' => 'view', $unitySector['Sector']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($unitySector['UnitySector']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($unitySector['UnitySector']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Unity Sector'), array('action' => 'edit', $unitySector['UnitySector']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Unity Sector'), array('action' => 'delete', $unitySector['UnitySector']['id']), null, __('Are you sure you want to delete # %s?', $unitySector['UnitySector']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Unity Sectors'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unity Sector'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Unities'), array('controller' => 'unities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unity'), array('controller' => 'unities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sectors'), array('controller' => 'sectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sector'), array('controller' => 'sectors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Employees'), array('controller' => 'employees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Employee'), array('controller' => 'employees', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Employees');?></h3>
	<?php if (!empty($unitySector['Employee'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Registration'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Birth Date'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Phone'); ?></th>
		<th><?php echo __('Rg'); ?></th>
		<th><?php echo __('Cpf'); ?></th>
		<th><?php echo __('Voter Card'); ?></th>
		<th><?php echo __('Ctps'); ?></th>
		<th><?php echo __('Reservist'); ?></th>
		<th><?php echo __('Agency'); ?></th>
		<th><?php echo __('Account'); ?></th>
		<th><?php echo __('Unity Sector Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($unitySector['Employee'] as $employee): ?>
		<tr>
			<td><?php echo $employee['id'];?></td>
			<td><?php echo $employee['registration'];?></td>
			<td><?php echo $employee['name'];?></td>
			<td><?php echo $employee['birth_date'];?></td>
			<td><?php echo $employee['email'];?></td>
			<td><?php echo $employee['phone'];?></td>
			<td><?php echo $employee['rg'];?></td>
			<td><?php echo $employee['cpf'];?></td>
			<td><?php echo $employee['voter_card'];?></td>
			<td><?php echo $employee['ctps'];?></td>
			<td><?php echo $employee['reservist'];?></td>
			<td><?php echo $employee['agency'];?></td>
			<td><?php echo $employee['account'];?></td>
			<td><?php echo $employee['unity_sector_id'];?></td>
			<td><?php echo $employee['created'];?></td>
			<td><?php echo $employee['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'employees', 'action' => 'view', $employee['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'employees', 'action' => 'edit', $employee['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'employees', 'action' => 'delete', $employee['id']), null, __('Are you sure you want to delete # %s?', $employee['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Employee'), array('controller' => 'employees', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
