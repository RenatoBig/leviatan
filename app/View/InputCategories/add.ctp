<script type="text/javascript">
$(document).ready(function() {

	//validação de formulário
	$("#InputCategoryAddForm").validate({ 
    	rules: { 			
			'data[InputCategory][name]':{
				required: true
			},
			'data[InputCategory][description]':{
				required: true
			}
		},
		messages: {
			'data[InputCategory][name]':{
				required: "Campo obrigatório"
			},
			'data[InputCategory][description]':{
				required: "Campo obrigatório"
			}
		}
	}); 
	
});
</script>

<div class="inputCategories form">
<?php echo $this->Form->create('InputCategory');?>
	<fieldset>
		<legend><?php echo __('Adicionar categoria de insumo'); ?></legend>
	<?php
		echo $this->Form->input('name', array('label'=>__('Nome')));
		echo $this->Form->input('description', array('label'=>__('Descrição')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Cadastrar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Listar categorias de insumos'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar insumos'), array('controller' => 'inputs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo insumo'), array('controller' => 'inputs', 'action' => 'add')); ?> </li>
	</ul>
</div>
