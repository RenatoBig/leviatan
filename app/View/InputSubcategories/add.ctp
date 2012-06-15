<script type="text/javascript">
$(document).ready(function() {

	//validação de formulário
	$("#InputSubcategoryAddForm").validate({ 
    	rules: { 			
			'data[InputSubcategory][name]':{
				required: true
			},
			'data[InputSubcategory][description]':{
				required: true
			}
		},
		messages: {
			'data[InputSubcategory][name]':{
				required: "Campo obrigatório"
			},
			'data[InputSubcategory][description]':{
				required: "Campo obrigatório"
			}
		}
	}); 
	
});
</script>

<div class="inputSubcategories form">
<?php echo $this->Form->create('InputSubcategory');?>
	<fieldset>
		<legend><?php echo __('Adicionar subcategoria de insumo'); ?></legend>
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

		<li><?php echo $this->Html->link(__('Listar subcategorias de insumos'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar insumos'), array('controller' => 'inputs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo insumo'), array('controller' => 'inputs', 'action' => 'add')); ?> </li>
	</ul>
</div>
