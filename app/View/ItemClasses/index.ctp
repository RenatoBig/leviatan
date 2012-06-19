<div class="itemClasses index">
	<h2><?php echo __('Itens das Classes');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id', 'ID');?></th>
			<th><?php echo $this->Paginator->sort('item_group_id', 'Grupos dos itens');?></th>
			<th><?php echo $this->Paginator->sort('keycode', 'Código');?></th>
			<th><?php echo $this->Paginator->sort('name', 'Nome');?></th>
			<th><?php echo $this->Paginator->sort('created', 'Criado');?></th>
			<th><?php echo $this->Paginator->sort('modified', 'Modificado');?></th>
			<th class="actions"><?php echo __('Ações');?></th>
	</tr>
	<?php
	foreach ($itemClasses as $itemClass): ?>
	<tr>
		<td><?php echo h($itemClass['ItemClass']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($itemClass['ItemGroup']['name'], array('controller' => 'item_groups', 'action' => 'view', $itemClass['ItemGroup']['id'])); ?>
		</td>
		<td><?php echo h($itemClass['ItemClass']['keycode']); ?>&nbsp;</td>
		<td><?php echo h($itemClass['ItemClass']['name']); ?>&nbsp;</td>
		<td><?php echo h($itemClass['ItemClass']['created']); ?>&nbsp;</td>
		<td><?php echo h($itemClass['ItemClass']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Visualizar'), array('action' => 'view', $itemClass['ItemClass']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $itemClass['ItemClass']['id'])); ?>
			<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $itemClass['ItemClass']['id']), null, __('Deseja realmente delear o item da classe #%s?', $itemClass['ItemClass']['name'])); ?>
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
		echo $this->Paginator->next(__('próxima') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Novo item da classe'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Listar grupos dos itens'), array('controller' => 'item_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo item do grupo'), array('controller' => 'item_groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar itens'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
