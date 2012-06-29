<div class="orders index">
	<h2><?php echo __('Orders');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id', 'ID');?></th>
			<th><?php echo $this->Paginator->sort('keycode', 'Código');?></th>
			<th><?php echo $this->Paginator->sort('user_id', 'Usuário');?></th>
			<th><?php echo $this->Paginator->sort('start_date', 'Data inicial');?></th>
			<th><?php echo $this->Paginator->sort('end_date', 'Data final');?></th>
			<th><?php echo $this->Paginator->sort('status_id', 'Status');?></th>
			<th><?php echo $this->Paginator->sort('created', 'Criado');?></th>
			<th><?php echo $this->Paginator->sort('modified', 'Modificado');?></th>
			<th class="actions"><?php echo __('Ações');?></th>
	</tr>
	<?php
	//debug($orders);exit;
	foreach ($orders as $order): ?>
	<tr>
		<td><?php echo h($order['Order']['id']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['keycode']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($order['User']['Employee']['name'], array('controller' => 'users', 'action' => 'view', $order['User']['id'])); ?>
		</td>
		<td><?php echo h($order['Order']['start_date']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['end_date']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($order['Status']['name'], array('controller' => 'statuses', 'action' => 'view', $order['Status']['id'])); ?>
		</td>
		<td><?php echo h($order['Order']['created']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Visualizar'), array('action' => 'view', $order['Order']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $order['Order']['id'])); ?>
			<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $order['Order']['id']), null, __('Deseja realmente deletar o pedido #%s?', $order['Order']['keycode'])); ?>
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
		<li><?php echo $this->Html->link(__('New Order'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Listar Usuários'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo usuário'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar status'), array('controller' => 'statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo status'), array('controller' => 'statuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Items'), array('controller' => 'order_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Item'), array('controller' => 'order_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
