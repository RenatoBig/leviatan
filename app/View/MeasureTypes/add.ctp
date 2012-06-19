<script>
$(document).ready(function() {

	//validação de formulário
	$("#MeasureTypeAddForm").validate({ 
    	rules: { 
			'data[MeasureType][name]':{
				required: true,
			},
			'data[MeasureType][description]':{
				required: true,
			}
		},
		messages: {
			'data[MeasureType][name]':{
				required: "Campo obrigatório.",
			},
			'data[MeasureType][description]':{
				required: "Campo obrigatório.",
			}
		}
	}); 
	
});
</script>

<div class="measureTypes form">
<?php echo $this->Form->create('MeasureType');?>
	<fieldset>
		<legend><?php echo __('Adicionar tipo de medida'); ?></legend>
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

		<li><?php echo $this->Html->link(__('Listar tipos de medidas'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar PNGCs'), array('controller' => 'pngc_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo PNGC'), array('controller' => 'pngc_codes', 'action' => 'add')); ?> </li>
	</ul>
</div>
