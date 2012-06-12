<div class="unities index">
	<h2><?php echo __('Unidades');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id', 'ID');?></th>
			<th><?php echo $this->Paginator->sort('cnes', 'CNES');?></th>
			<th><?php echo $this->Paginator->sort('cnpj', 'CNPJ');?></th>
			<th><?php echo $this->Paginator->sort('name', 'Nome');?></th>
			<th><?php echo $this->Paginator->sort('trade_name', 'Nome fantasia');?></th>
			<th><?php echo $this->Paginator->sort('address', 'Endereço');?></th>
			<th><?php echo $this->Paginator->sort('number', 'Número');?></th>
			<th><?php echo $this->Paginator->sort('cep', 'CEP');?></th>
			<th><?php echo $this->Paginator->sort('phone', 'Telefone');?></th>
			<th><?php echo $this->Paginator->sort('fax', 'FAX');?></th>
			<th><?php echo $this->Paginator->sort('region_id', 'Região');?></th>
			<th><?php echo $this->Paginator->sort('health_district_id', 'Distrito sanitário');?></th>
			<th><?php echo $this->Paginator->sort('unity_type_id', 'Tipo da unidade');?></th>
			<th><?php echo $this->Paginator->sort('created', 'Criado');?></th>
			<th><?php echo $this->Paginator->sort('modified', 'Modificado');?></th>
			<th class="actions"><?php echo __('Ações');?></th>
	</tr>
	<?php
	foreach ($unities as $unity): ?>
	<tr>
		<td><?php echo h($unity['Unity']['id']); ?>&nbsp;</td>
		<td><?php echo h($unity['Unity']['cnes']); ?>&nbsp;</td>
		<td><?php echo h($unity['Unity']['cnpj']); ?>&nbsp;</td>
		<td><?php echo h($unity['Unity']['name']); ?>&nbsp;</td>
		<td><?php echo h($unity['Unity']['trade_name']); ?>&nbsp;</td>
		<td><?php echo h($unity['Unity']['address']); ?>&nbsp;</td>
		<td><?php echo h($unity['Unity']['number']); ?>&nbsp;</td>
		<td><?php echo h($unity['Unity']['cep']); ?>&nbsp;</td>
		<td><?php echo h($unity['Unity']['phone']); ?>&nbsp;</td>
		<td><?php echo h($unity['Unity']['fax']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($unity['Region']['id'], array('controller' => 'regions', 'action' => 'view', $unity['Region']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($unity['HealthDistrict']['name'], array('controller' => 'health_districts', 'action' => 'view', $unity['HealthDistrict']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($unity['UnityType']['name'], array('controller' => 'unity_types', 'action' => 'view', $unity['UnityType']['id'])); ?>
		</td>
		<td><?php echo h($unity['Unity']['created']); ?>&nbsp;</td>
		<td><?php echo h($unity['Unity']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Visualizar'), array('action' => 'view', $unity['Unity']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $unity['Unity']['id'])); ?>
			<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $unity['Unity']['id']), null, __('Deseja realmente deletar a unidade #%s?', $unity['Unity']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('anterior'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('próximo') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Nova unidade'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Listar regiões'), array('controller' => 'regions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova região'), array('controller' => 'regions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar distritos sanitários'), array('controller' => 'health_districts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo distrito sanitário'), array('controller' => 'health_districts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar tipos das unidades'), array('controller' => 'unity_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo tipo da unidade'), array('controller' => 'unity_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar unidades_setores'), array('controller' => 'unity_sectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo unidade_setor'), array('controller' => 'unity_sectors', 'action' => 'add')); ?> </li>
	</ul>
</div>
