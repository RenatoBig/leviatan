<div class="unityTypes view">
<h2><?php  echo __('Unity Type');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($unityType['UnityType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($unityType['UnityType']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($unityType['UnityType']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($unityType['UnityType']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Unity Type'), array('action' => 'edit', $unityType['UnityType']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Unity Type'), array('action' => 'delete', $unityType['UnityType']['id']), null, __('Are you sure you want to delete # %s?', $unityType['UnityType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Unity Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unity Type'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Unities'), array('controller' => 'unities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unity'), array('controller' => 'unities', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Unities');?></h3>
	<?php if (!empty($unityType['Unity'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Cnes'); ?></th>
		<th><?php echo __('Cnpj'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Trade Name'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('Number'); ?></th>
		<th><?php echo __('Cep'); ?></th>
		<th><?php echo __('Phone'); ?></th>
		<th><?php echo __('Fax'); ?></th>
		<th><?php echo __('Region Id'); ?></th>
		<th><?php echo __('Health District Id'); ?></th>
		<th><?php echo __('Unity Type Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($unityType['Unity'] as $unity): ?>
		<tr>
			<td><?php echo $unity['id'];?></td>
			<td><?php echo $unity['cnes'];?></td>
			<td><?php echo $unity['cnpj'];?></td>
			<td><?php echo $unity['name'];?></td>
			<td><?php echo $unity['trade_name'];?></td>
			<td><?php echo $unity['address'];?></td>
			<td><?php echo $unity['number'];?></td>
			<td><?php echo $unity['cep'];?></td>
			<td><?php echo $unity['phone'];?></td>
			<td><?php echo $unity['fax'];?></td>
			<td><?php echo $unity['region_id'];?></td>
			<td><?php echo $unity['health_district_id'];?></td>
			<td><?php echo $unity['unity_type_id'];?></td>
			<td><?php echo $unity['created'];?></td>
			<td><?php echo $unity['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'unities', 'action' => 'view', $unity['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'unities', 'action' => 'edit', $unity['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'unities', 'action' => 'delete', $unity['id']), null, __('Are you sure you want to delete # %s?', $unity['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Unity'), array('controller' => 'unities', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
