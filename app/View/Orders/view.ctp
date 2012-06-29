<div class="orders view">
<h2><?php  echo __('Order');?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($order['Order']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Código'); ?></dt>
		<dd>
			<?php echo h($order['Order']['keycode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Usuário'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Employee']['name'], array('controller' => 'users', 'action' => 'view', $order['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Data inicial'); ?></dt>
		<dd>
			<?php echo h($order['Order']['start_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Data final'); ?></dt>
		<dd>
			<?php echo h($order['Order']['end_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo $this->Html->link($order['Status']['name'], array('controller' => 'statuses', 'action' => 'view', $order['Status']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Criado'); ?></dt>
		<dd>
			<?php echo h($order['Order']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($order['Order']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar Order'), array('action' => 'edit', $order['Order']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Deletar Order'), array('action' => 'delete', $order['Order']['id']), null, __('Deseja realmente deletar o pedido #%s?', $order['Order']['keycode'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Usuários'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo usuário'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Status'), array('controller' => 'statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo Status'), array('controller' => 'statuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Items'), array('controller' => 'order_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Item'), array('controller' => 'order_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
