<script>
$(document).ready(function() {

	//validação de formulário
	$("#UnityTypeEditForm").validate({ 
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
		<legend><?php echo __('Editar tipo da unidade'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label'=>__('Nome')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Alterar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Deletar tipo da unidade'), array('action' => 'delete', $this->Form->value('UnityType.id')), null, __('Deseja realmente deletar o tipo da unidade #%s?', $this->Form->value('UnityType.name'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar tipos das unidades'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar unidades'), array('controller' => 'unities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova unidade'), array('controller' => 'unities', 'action' => 'add')); ?> </li>
	</ul>
</div>
