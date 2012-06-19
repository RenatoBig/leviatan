<script>
$(document).ready(function() {

	//validação de formulário
	$("#FunctionalUnitAddForm").validate({ 
    	rules: { 
			'data[FunctionalUnit][name]':{
				required: true,
			},
			'data[FunctionalUnit][description]':{
				required: true,
			}
		},
		messages: {
			'data[FunctionalUnit][name]':{
				required: "Campo obrigatório.",
			},
			'data[FunctionalUnit][description]':{
				required: "Campo obrigatório.",
			}
		}
	}); 
	
});
</script>

<div class="functionalUnits form">
<?php echo $this->Form->create('FunctionalUnit');?>
	<fieldset>
		<legend><?php echo __('Adicionar unidade funcional'); ?></legend>
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

		<li><?php echo $this->Html->link(__('Listar unidades funcionais'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar PNGCs'), array('controller' => 'pngc_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo PNGC'), array('controller' => 'pngc_codes', 'action' => 'add')); ?> </li>
	</ul>
</div>
