<div class="homologations index">
	<h2><?php echo __('Homologações');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id', 'ID');?></th>
			<th><?php echo $this->Paginator->sort('order_item_id', 'Item do pedido');?></th>
			<th><?php echo $this->Paginator->sort('remark', 'Observação');?></th>
			<th><?php echo $this->Paginator->sort('created', 'Criado');?></th>
			<th><?php echo $this->Paginator->sort('modified', 'Modificado');?></th>
			<th class="actions"><?php echo __('Ações');?></th>
	</tr>
	<?php
	foreach ($homologations as $homologation): ?>
	<tr>
		<td><?php echo h($homologation['Homologation']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($homologation['OrderItem']['id'], array('controller' => 'order_items', 'action' => 'view', $homologation['OrderItem']['id'])); ?>
		</td>
		<td><?php echo h($homologation['Homologation']['remark']); ?>&nbsp;</td>
		<td><?php echo h($homologation['Homologation']['created']); ?>&nbsp;</td>
		<td><?php echo h($homologation['Homologation']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Visualizar'), array('action' => 'view', $homologation['Homologation']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $homologation['Homologation']['id'])); ?>
			<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $homologation['Homologation']['id']), null, __('Deseja realmente deletar a homologação #%s?', $homologation['Homologation']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('Nova homologação'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Listar itens dos pedidos'), array('controller' => 'order_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo item do pedido'), array('controller' => 'order_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
