<script type="text/javascript">
$(document).ready(function() {

	//validação de formulário
	$("#ItemGroupEditForm").validate({ 
    	rules: { 
			'data[ItemGroup][group_type_id]':{
				required: true,
			},
			'data[ItemGroup][name]':{
				required: true
			},
			'data[ItemGroup][keycode]':{
				required: true
			}
		},
		messages: {
			'data[ItemGroup][group_type_id]':{
				required: "Este campo é obrigatório"
			},
			'data[ItemGroup][name]':{
				required: "Este campo é obrigatório"
			},
			'data[ItemGroup][keycode]':{
				required: "Este campo é obrigatório"
			}
		}
	}); 
	
});
</script>

<div class="itemGroups form">
<?php echo $this->Form->create('ItemGroup');?>
	<fieldset>
		<legend><?php echo __('Editar item do grupo'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('group_type_id', array('label'=>'Tipo do grupo'));
		echo $this->Form->input('keycode', array('label'=>'Código'));
		echo $this->Form->input('name', array('label'=>'Nome'));		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Alterar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Deletar item do grupo'), array('action' => 'delete', $this->Form->value('ItemGroup.id')), null, __('Deseja realmente deletar o item do grupo #%s?', $this->Form->value('ItemGroup.name'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar itens dos grupos'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar tipos dos grupos'), array('controller' => 'group_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo tipo do grupo'), array('controller' => 'group_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
