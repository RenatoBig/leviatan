<div class="inputs index">
	<h2><?php echo __('Insumos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id', 'ID');?></th>
			<th><?php echo $this->Paginator->sort('input_category_id', 'Categoria');?></th>
			<th><?php echo $this->Paginator->sort('input_subcategory_id', 'Subcategoria');?></th>
			<th><?php echo $this->Paginator->sort('created', 'Criado');?></th>
			<th><?php echo $this->Paginator->sort('modified', 'Modificado');?></th>
			<th class="actions"><?php echo __('Ações');?></th>
	</tr>
	<?php
	foreach ($inputs as $input): ?>
	<tr>
		<td><?php echo h($input['Input']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($input['InputCategory']['name'], array('controller' => 'input_categories', 'action' => 'view', $input['InputCategory']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($input['InputSubcategory']['name'], array('controller' => 'input_subcategories', 'action' => 'view', $input['InputSubcategory']['id'])); ?>
		</td>
		<td><?php echo h($input['Input']['created']); ?>&nbsp;</td>
		<td><?php echo h($input['Input']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Visualizar'), array('action' => 'view', $input['Input']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $input['Input']['id'])); ?>
			<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $input['Input']['id']), null, __('Deseja realmente deletar o insumo # %s?', $input['Input']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('Novo insumo'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Listar categorias'), array('controller' => 'input_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova categoria'), array('controller' => 'input_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar subcategorias'), array('controller' => 'input_subcategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova subcategoria'), array('controller' => 'input_subcategories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar PNGCs'), array('controller' => 'pngc_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo PNGC'), array('controller' => 'pngc_codes', 'action' => 'add')); ?> </li>
	</ul>
</div>
