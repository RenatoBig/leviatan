<div class="itemGroups index">
	<h2><?php echo __('Itens dos grupos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id', 'ID');?></th>
			<th><?php echo $this->Paginator->sort('group_type_id', 'Tipo do grupo');?></th>
			<th><?php echo $this->Paginator->sort('keycode', 'Código');?></th>
			<th><?php echo $this->Paginator->sort('name', 'Nome');?></th>			
			<th><?php echo $this->Paginator->sort('created', 'Criado');?></th>
			<th><?php echo $this->Paginator->sort('modified', 'Modificado');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($itemGroups as $itemGroup): ?>
	<tr>
		<td><?php echo h($itemGroup['ItemGroup']['id']); ?>&nbsp;</td>
		<td><?php echo h($itemGroup['ItemGroup']['keycode']); ?>&nbsp;</td>
		<td><?php echo h($itemGroup['ItemGroup']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($itemGroup['GroupType']['name'], array('controller' => 'group_types', 'action' => 'view', $itemGroup['GroupType']['id'])); ?>
		</td>
		<td><?php echo h($itemGroup['ItemGroup']['created']); ?>&nbsp;</td>
		<td><?php echo h($itemGroup['ItemGroup']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Visualizar'), array('action' => 'view', $itemGroup['ItemGroup']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $itemGroup['ItemGroup']['id'])); ?>
			<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $itemGroup['ItemGroup']['id']), null, __('Deseja realmente deletar o item do grupo #%s?', $itemGroup['ItemGroup']['name'])); ?>
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
		<li><?php echo $this->Html->link(__('Novo item do grupo'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Listar tipos dos grupos'), array('controller' => 'group_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo tipo do grupo'), array('controller' => 'group_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
