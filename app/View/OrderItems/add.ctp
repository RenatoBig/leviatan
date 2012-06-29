<script>
$(document).ready(function() {

	//validação de formulário
	$("#OrderItemAddForm").validate({ 
    	rules: { 
			'data[OrderItem][order_id]':{
				required: true,
			},
			'data[OrderItem][item_id]':{
				required: true,
			},
			'data[OrderItem][status_id]':{
				required: true,
			},
			'data[OrderItem][quantity]':{
				required: true,
			}
		},
		messages: {
			'data[OrderItem][order_id]':{
				required: "Campo obrigatório.",
			},
			'data[OrderItem][item_id]':{
				required: "Campo obrigatório.",
			},
			'data[OrderItem][status_id]':{
				required: "Campo obrigatório.",
			},
			'data[OrderItem][quantity]':{
				required: "Campo obrigatório.",
			}
		}
	}); 
	
});
</script>

<div class="orderItems form">
<?php echo $this->Form->create('OrderItem');?>
	<fieldset>
		<legend><?php echo __('Adicionar item ao pedido'); ?></legend>
	<?php
		echo $this->Form->input('order_id', array('label'=>__('Pedido')));
		echo $this->Form->input('item_id', array('label'=>__('Item')));
		echo $this->Form->input('quantity', array('label'=>__('Quantidade')));
		echo $this->Form->input('status_id', array('label'=>__('Status')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Cadastrar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Listar itens do pedido'), array('action' => 'index'));?></li>
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
