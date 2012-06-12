<script>
$(document).ready(function() {

	//validação de formulário
	$("#UnityTypeAddForm").validate({ 
    	rules: { 			
			'data[UnityType][name]':{
				required: true
			}
		},
		messages: {
			
			'data[UnityType][name]':{
				required: "Campo obrigatório."
			}
		}
	}); 
	
});
</script>
<div class="unityTypes form">
<?php echo $this->Form->create('UnityType');?>
	<fieldset>
		<legend><?php echo __('Adicionar tipo da unidade'); ?></legend>
	<?php
		echo $this->Form->input('name', array('label'=>__('Nome')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Cadastrar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Listar tipo das unidades'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar unidades'), array('controller' => 'unities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova unidade'), array('controller' => 'unities', 'action' => 'add')); ?> </li>
	</ul>
</div>
