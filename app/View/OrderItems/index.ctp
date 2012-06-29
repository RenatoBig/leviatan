<div class="orderItems index">
	<h2><?php echo __('Itens dos pedidos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id', 'ID');?></th>
			<th><?php echo $this->Paginator->sort('order_id', 'Pedido');?></th>
			<th><?php echo $this->Paginator->sort('item_id', 'Item');?></th>
			<th><?php echo $this->Paginator->sort('quantity', 'Quantidade');?></th>
			<th><?php echo $this->Paginator->sort('status_id', 'Status');?></th>
			<th><?php echo $this->Paginator->sort('created', 'Criado');?></th>
			<th><?php echo $this->Paginator->sort('modified', 'Modificado');?></th>
			<th class="actions"><?php echo __('Ações');?></th>
	</tr>
	<?php
	foreach ($orderItems as $orderItem): ?>
	<tr>
		<td><?php echo h($orderItem['OrderItem']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($orderItem['Order']['keycode'], array('controller' => 'orders', 'action' => 'view', $orderItem['Order']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($orderItem['Item']['name'], array('controller' => 'items', 'action' => 'view', $orderItem['Item']['id'])); ?>
		</td>
		<td><?php echo h($orderItem['OrderItem']['quantity']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($orderItem['Status']['name'], array('controller' => 'statuses', 'action' => 'view', $orderItem['Status']['id'])); ?>
		</td>
		<td><?php echo h($orderItem['OrderItem']['created']); ?>&nbsp;</td>
		<td><?php echo h($orderItem['OrderItem']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Visualizar'), array('action' => 'view', $orderItem['OrderItem']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $orderItem['OrderItem']['id'])); ?>
			<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $orderItem['OrderItem']['id']), null, __('Deseja realmente deletar o item do pedido #%s?', $orderItem['OrderItem']['id'])); ?>
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
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Novo item do pedido'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Listar pedidos'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo pedido'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar itens'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar status'), array('controller' => 'statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo status'), array('controller' => 'statuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar homologações'), array('controller' => 'homologations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova homologação'), array('controller' => 'homologations', 'action' => 'add')); ?> </li>
	</ul>
</div>
