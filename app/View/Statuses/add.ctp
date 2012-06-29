<script>
$(document).ready(function() {

	//validação de formulário
	$("#StatusAddForm").validate({ 
    	rules: { 
			'data[Status][name]':{
				required: true
			}
		},
		messages: {
			'data[Status][name]':{
				required: "Campo obrigatório."
			}
		}
	}); 
	
});
</script>

<div class="statuses form">
<?php echo $this->Form->create('Status');?>
	<fieldset>
		<legend><?php echo __('Adicionar status'); ?></legend>
	<?php
		echo $this->Form->input('name', array('label'=>__('Nome')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Cadastrar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Listar status'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Order Items'), array('controller' => 'order_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Item'), array('controller' => 'order_items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
	</ul>
</div>
