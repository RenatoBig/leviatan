<script>
$(document).ready(function() {

	//validação de formulário
	$("#MeasureTypeEditForm").validate({ 
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
		<legend><?php echo __('Editar tipo de medida'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label'=>__('Nome')));
		echo $this->Form->input('description', array('label'=>__('Descrição')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Alterar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Deletar tipo de medida'), array('action' => 'delete', $this->Form->value('MeasureType.id')), null, __('Deseja realemtne deletar o tipo de medida #%s?', $this->Form->value('MeasureType.name'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar tipos de medidas'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar PNGCs'), array('controller' => 'pngc_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo PNGC'), array('controller' => 'pngc_codes', 'action' => 'add')); ?> </li>
	</ul>
</div>
