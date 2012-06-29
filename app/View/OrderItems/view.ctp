<div class="orderItems view">
<h2><?php  echo __('Item do pedido');?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($orderItem['OrderItem']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pedido'); ?></dt>
		<dd>
			<?php echo $this->Html->link($orderItem['Order']['keycode'], array('controller' => 'orders', 'action' => 'view', $orderItem['Order']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item'); ?></dt>
		<dd>
			<?php echo $this->Html->link($orderItem['Item']['name'], array('controller' => 'items', 'action' => 'view', $orderItem['Item']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantidade'); ?></dt>
		<dd>
			<?php echo h($orderItem['OrderItem']['quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo $this->Html->link($orderItem['Status']['name'], array('controller' => 'statuses', 'action' => 'view', $orderItem['Status']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Criado'); ?></dt>
		<dd>
			<?php echo h($orderItem['OrderItem']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($orderItem['OrderItem']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar item do pedido'), array('action' => 'edit', $orderItem['OrderItem']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Deletar item do pedido'), array('action' => 'delete', $orderItem['OrderItem']['id']), null, __('Are you sure you want to delete # %s?', $orderItem['OrderItem']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listar itens dos pedidos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo item do pedido'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar pedidos'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo pedido'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar itens'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar status'), array('controller' => 'statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo status'), array('controller' => 'statuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Homologações'), array('controller' => 'homologations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova homologação'), array('controller' => 'homologations', 'action' => 'add')); ?> </li>
	</ul>
</div>
