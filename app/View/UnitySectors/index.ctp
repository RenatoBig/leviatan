<div class="unitySectors index">
	<h2><?php echo __('Unidades_setores');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id', 'ID');?></th>
			<th><?php echo $this->Paginator->sort('unity_id', 'Unidade');?></th>
			<th><?php echo $this->Paginator->sort('sector_id', 'Setor');?></th>
			<th><?php echo $this->Paginator->sort('created', 'Criado');?></th>
			<th><?php echo $this->Paginator->sort('modified', 'Modificado');?></th>
			<th class="actions"><?php echo __('Ações');?></th>
	</tr>
	<?php
	foreach ($unitySectors as $unitySector): ?>
	<tr>
		<td><?php echo h($unitySector['UnitySector']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($unitySector['Unity']['name'], array('controller' => 'unities', 'action' => 'view', $unitySector['Unity']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($unitySector['Sector']['name'], array('controller' => 'sectors', 'action' => 'view', $unitySector['Sector']['id'])); ?>
		</td>
		<td><?php echo h($unitySector['UnitySector']['created']); ?>&nbsp;</td>
		<td><?php echo h($unitySector['UnitySector']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Visualizar'), array('action' => 'view', $unitySector['UnitySector']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $unitySector['UnitySector']['id'])); ?>
			<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $unitySector['UnitySector']['id']), null, __('Deseja realmente deletar a unidade_setor # %s?', $unitySector['UnitySector']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('Nova unidade_setor'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Listar unidades'), array('controller' => 'unities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova unidade'), array('controller' => 'unities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar setores'), array('controller' => 'sectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo setor'), array('controller' => 'sectors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar funcionários'), array('controller' => 'employees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo funcionário'), array('controller' => 'employees', 'action' => 'add')); ?> </li>
	</ul>
</div>
