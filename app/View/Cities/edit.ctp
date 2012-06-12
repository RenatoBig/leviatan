<script>
$(document).ready(function() {

	//validação de formulário
	$("#CityEditForm").validate({ 
    	rules: { 
			'data[City][keycode]':{
				required: true,
				number: true,
				minlength: 6
			},
			'data[City][name]':{
				required: true
			}
		},
		messages: {
			'data[City][keycode]':{
				required: "Campo obrigatório.",
				minlength: "Quantidade mínima de dígitos é 6.",
				number: "Apenas números são permitidos."					
			},
			'data[City][name]':{
				required: "Campo obrigatório."
			}
		}
	}); 
	
});
</script>

<div class="cities form">
<?php echo $this->Form->create('City');?>
	<fieldset>
		<legend><?php echo __('Editar cidade'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('keycode', array('label'=>__('Código')));
		echo $this->Form->input('name', array('label'=>__('Nome')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Alterar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Deletar cidade'), array('action' => 'delete', $this->Form->value('City.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('City.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Lista cidades'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('lista de regiões'), array('controller' => 'regions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova região'), array('controller' => 'regions', 'action' => 'add')); ?> </li>
	</ul>
</div>
