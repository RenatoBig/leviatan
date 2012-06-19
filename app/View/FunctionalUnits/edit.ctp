<script>
$(document).ready(function() {

	//validação de formulário
	$("#FunctionalUnitEditForm").validate({ 
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
		<legend><?php echo __('Editar unidade funcional'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label'=>_('Nome')));
		echo $this->Form->input('description', array('label'=>__('Descrição')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Alterar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Deletar unidade funcional'), array('action' => 'delete', $this->Form->value('FunctionalUnit.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('FunctionalUnit.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar unidades funcionais'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar PNGCs'), array('controller' => 'pngc_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo PNGC'), array('controller' => 'pngc_codes', 'action' => 'add')); ?> </li>
	</ul>
</div>
