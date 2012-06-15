<div class="inputSubcategories index">
	<h2><?php echo __('Subcategorias de insumos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id', 'ID');?></th>
			<th><?php echo $this->Paginator->sort('name', 'Nome');?></th>
			<th><?php echo $this->Paginator->sort('description', 'Descrição');?></th>
			<th><?php echo $this->Paginator->sort('created', 'Criado');?></th>
			<th><?php echo $this->Paginator->sort('modified', 'Modificado');?></th>
			<th class="actions"><?php echo __('Ações');?></th>
	</tr>
	<?php
	foreach ($inputSubcategories as $inputSubcategory): ?>
	<tr>
		<td><?php echo h($inputSubcategory['InputSubcategory']['id']); ?>&nbsp;</td>
		<td><?php echo h($inputSubcategory['InputSubcategory']['name']); ?>&nbsp;</td>
		<td><?php echo h($inputSubcategory['InputSubcategory']['description']); ?>&nbsp;</td>
		<td><?php echo h($inputSubcategory['InputSubcategory']['created']); ?>&nbsp;</td>
		<td><?php echo h($inputSubcategory['InputSubcategory']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Visualizar'), array('action' => 'view', $inputSubcategory['InputSubcategory']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $inputSubcategory['InputSubcategory']['id'])); ?>
			<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $inputSubcategory['InputSubcategory']['id']), null, __('Deseja realmente deletar a subcategoria #%s?', $inputSubcategory['InputSubcategory']['name'])); ?>
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
		<li><?php echo $this->Html->link(__('Nova subcategoria de insumo'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Listar insumos'), array('controller' => 'inputs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novos insumos'), array('controller' => 'inputs', 'action' => 'add')); ?> </li>
	</ul>
</div>
