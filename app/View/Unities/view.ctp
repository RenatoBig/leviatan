<div class="unities view">
<h2><?php  echo __('Unity');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($unity['Unity']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cnes'); ?></dt>
		<dd>
			<?php echo h($unity['Unity']['cnes']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cnpj'); ?></dt>
		<dd>
			<?php echo h($unity['Unity']['cnpj']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($unity['Unity']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trade Name'); ?></dt>
		<dd>
			<?php echo h($unity['Unity']['trade_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($unity['Unity']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Number'); ?></dt>
		<dd>
			<?php echo h($unity['Unity']['number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cep'); ?></dt>
		<dd>
			<?php echo h($unity['Unity']['cep']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($unity['Unity']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fax'); ?></dt>
		<dd>
			<?php echo h($unity['Unity']['fax']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Region'); ?></dt>
		<dd>
			<?php echo $this->Html->link($unity['Region']['id'], array('controller' => 'regions', 'action' => 'view', $unity['Region']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Health District'); ?></dt>
		<dd>
			<?php echo $this->Html->link($unity['HealthDistrict']['name'], array('controller' => 'health_districts', 'action' => 'view', $unity['HealthDistrict']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unity Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($unity['UnityType']['name'], array('controller' => 'unity_types', 'action' => 'view', $unity['UnityType']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($unity['Unity']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($unity['Unity']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Unity'), array('action' => 'edit', $unity['Unity']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Unity'), array('action' => 'delete', $unity['Unity']['id']), null, __('Are you sure you want to delete # %s?', $unity['Unity']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Unities'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unity'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Regions'), array('controller' => 'regions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Region'), array('controller' => 'regions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Health Districts'), array('controller' => 'health_districts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Health District'), array('controller' => 'health_districts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Unity Types'), array('controller' => 'unity_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unity Type'), array('controller' => 'unity_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Unity Sectors'), array('controller' => 'unity_sectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unity Sector'), array('controller' => 'unity_sectors', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Unity Sectors');?></h3>
	<?php if (!empty($unity['UnitySector'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Unity Id'); ?></th>
		<th><?php echo __('Sector Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($unity['UnitySector'] as $unitySector): ?>
		<tr>
			<td><?php echo $unitySector['id'];?></td>
			<td><?php echo $unitySector['unity_id'];?></td>
			<td><?php echo $unitySector['sector_id'];?></td>
			<td><?php echo $unitySector['created'];?></td>
			<td><?php echo $unitySector['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'unity_sectors', 'action' => 'view', $unitySector['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'unity_sectors', 'action' => 'edit', $unitySector['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'unity_sectors', 'action' => 'delete', $unitySector['id']), null, __('Are you sure you want to delete # %s?', $unitySector['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Unity Sector'), array('controller' => 'unity_sectors', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
