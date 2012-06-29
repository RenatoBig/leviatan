<script>
$(document).ready(function() {

	//validação de formulário
	$("#HomologationEditForm").validate({ 
    	rules: { 
			'data[Homologation][order_item_id]':{
				required: true
			},
			'data[Homologation][remark]':{
				required: true
			}
		},
		messages: {
			'data[Homologation][order_item_id]':{
				required: "Campo obrigatório."
			},
			'data[Homologation][remark]':{
				required: "Campo obrigatório"
			}
		}
	}); 
	
});
</script>

<div class="homologations form">
<?php echo $this->Form->create('Homologation');?>
	<fieldset>
		<legend><?php echo __('Edit Homologação'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('order_item_id', array('label'=>__('Item do pedido')));
		echo $this->Form->input('remark', array('label'=>__('Observação')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Alterar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $this->Form->value('Homologation.id')), null, __('Deseja realmente deletar a homologação #%s?', $this->Form->value('Homologation.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Homologação'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar itens dos pedidos'), array('controller' => 'order_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo item do pedido'), array('controller' => 'order_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
