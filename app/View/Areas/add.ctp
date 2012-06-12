<script>
$(document).ready(function() {

	//validação de formulário
	$("#AreaAddForm").validate({ 
    	rules: { 
			'data[Area][name]':{
				required: true
			}
		},
		messages: {
			'data[Area][name]':{
				required: "Campo obrigatório."
			}
		}
	}); 
	
});
</script>

<div class="areas form">
<?php echo $this->Form->create('Area');?>
	<fieldset>
		<legend><?php echo __('Adicionar área'); ?></legend>
	<?php
		echo $this->Form->input('name', array('label'=>__('Nome')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Cadastrar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Lista de áreas'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Lista de regiões'), array('controller' => 'regions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova região'), array('controller' => 'regions', 'action' => 'add')); ?> </li>
	</ul>
</div>
