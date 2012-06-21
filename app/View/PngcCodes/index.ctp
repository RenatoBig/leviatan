<div class="pngcCodes index">
	<h2><?php echo __('PNGCs');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id', 'ID');?></th>
			<th><?php echo $this->Paginator->sort('keycode', 'Código');?></th>
			<th><?php echo $this->Paginator->sort('expense_group_id', 'Grupo de gastos');?></th>
			<th><?php echo $this->Paginator->sort('functional_unit_id', 'Unidade funcional');?></th>
			<th><?php echo $this->Paginator->sort('input_id', 'Insumo');?></th>
			<th><?php echo $this->Paginator->sort('measure_type_id', 'Tipo de medida');?></th>
			<th><?php echo $this->Paginator->sort('created', 'Criado');?></th>
			<th><?php echo $this->Paginator->sort('modified', 'Modificado');?></th>
			<th class="actions"><?php echo __('Ações');?></th>
	</tr>
	<?php
	foreach ($pngcCodes as $pngcCode): ?>
	<tr>
		<td><?php echo h($pngcCode['PngcCode']['id']); ?>&nbsp;</td>
		<td><?php echo h($pngcCode['PngcCode']['keycode']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($pngcCode['ExpenseGroup']['name'], array('controller' => 'expense_groups', 'action' => 'view', $pngcCode['ExpenseGroup']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($pngcCode['FunctionalUnit']['name'], array('controller' => 'functional_units', 'action' => 'view', $pngcCode['FunctionalUnit']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($pngcCode['Input']['id'], array('controller' => 'inputs', 'action' => 'view', $pngcCode['Input']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($pngcCode['MeasureType']['name'], array('controller' => 'measure_types', 'action' => 'view', $pngcCode['MeasureType']['id'])); ?>
		</td>
		<td><?php echo h($pngcCode['PngcCode']['created']); ?>&nbsp;</td>
		<td><?php echo h($pngcCode['PngcCode']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Visualizar'), array('action' => 'view', $pngcCode['PngcCode']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $pngcCode['PngcCode']['id'])); ?>
			<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $pngcCode['PngcCode']['id']), null, __('Deseja realmente deletar o PNGC #%s?', $pngcCode['PngcCode']['keycode'])); ?>
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
		<li><?php echo $this->Html->link(__('Novo PNGC'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Listar grupo de gastos'), array('controller' => 'expense_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo grupo de gastos'), array('controller' => 'expense_groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar unidades funcionais'), array('controller' => 'functional_units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova unidade funcional'), array('controller' => 'functional_units', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar categorias de insumos'), array('controller' => 'input_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova categoria de insumos'), array('controller' => 'input_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar subcategorias de insumos'), array('controller' => 'input_subcategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova subcategoria de insumos'), array('controller' => 'input_subcategories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar tipos de medidas'), array('controller' => 'measure_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo tipo de medida'), array('controller' => 'measure_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar itens'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
