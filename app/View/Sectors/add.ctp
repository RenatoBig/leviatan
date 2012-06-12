<script>
$(document).ready(function() {

	//validação de formulário
	$("#SectorAddForm").validate({ 
    	rules: { 
			'data[Sector][name]':{
				required: true
			}
		},
		messages: {
			'data[Sector][name]':{
				required: "Campo obrigatório."
			}
		}
	}); 
	
});
</script>

<div class="sectors form">
<?php echo $this->Form->create('Sector');?>
	<fieldset>
		<legend><?php echo __('Adicionar setor'); ?></legend>
	<?php
		echo $this->Form->input('name', array('label'=>__('Nome')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Cadastrar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Listar Setores'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar unidades_setores'), array('controller' => 'unity_sectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo unidade_setor'), array('controller' => 'unity_sectors', 'action' => 'add')); ?> </li>
	</ul>
</div>
