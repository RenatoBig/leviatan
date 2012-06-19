<script>
$(document).ready(function() {

	//validação de formulário
	$("#ItemClassAddForm").validate({ 
    	rules: { 
			'data[ItemClass][item_group_id]':{
				required: true,
			},
			'data[ItemClass][name]':{
				required: true
			},
			'data[ItemClass][keycode]':{
				required: true
			}
		},
		messages: {
			'data[ItemClass][item_group_id]':{
				required: "Este campo é obrigatório"
			},
			'data[ItemClass][name]':{
				required: "Este campo é obrigatório"
			},
			'data[ItemClass][keycode]':{
				required: "Este campo é obrigatório"
			}
		}
	}); 
	
});
</script>
<div class="itemClasses form">
<?php echo $this->Form->create('ItemClass');?>
	<fieldset>
		<legend><?php echo __('Adicionar classe do item'); ?></legend>
	<?php
		echo $this->Form->input('item_group_id', array('label'=>'Grupo do item'));
		echo $this->Form->input('keycode', array('label'=>'Código'));
		echo $this->Form->input('name', array('label'=>'Nome'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Cadastrar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Listar classes dos itens'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar grupos dos itens'), array('controller' => 'item_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo grupo do item'), array('controller' => 'item_groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar itens'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
