<div class="homologations view">
<h2><?php  echo __('Homologação');?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($homologation['Homologation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item do pedido'); ?></dt>
		<dd>
			<?php echo $this->Html->link($orderItem['Order']['keycode'].' - '.$orderItem['Item']['name'], array('controller' => 'order_items', 'action' => 'view', $homologation['OrderItem']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Observação'); ?></dt>
		<dd>
			<?php echo h($homologation['Homologation']['remark']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Criado'); ?></dt>
		<dd>
			<?php echo h($homologation['Homologation']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($homologation['Homologation']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar homologação'), array('action' => 'edit', $homologation['Homologation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Deletar homologação'), array('action' => 'delete', $homologation['Homologation']['id']), null, __('Deseja realmente deletar a homologação #%s?', $homologation['Homologation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listar homologações'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova homologação'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar itens dos pedidos'), array('controller' => 'order_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo item do pedido'), array('controller' => 'order_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
