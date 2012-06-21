<script>
$(document).ready(function() {

	//validação de formulário
	$("#ItemEditForm").validate({ 
    	rules: { 
			'data[Item][item_class_id]':{
				required: true,
			},
			'data[Item][pngc_code_id]':{
				required: true
			},
			'data[Item][name]':{
				required: true
			},
			'data[Item][description]':{
				required: true
			}
		},
		messages: {
			'data[Item][item_class_id]':{
				required: "Campo obrigatório"
			},
			'data[Item][pngc_code_id]':{
				required: "Campo obrigatório"
			},
			'data[Item][name]':{
				required: "Campo obrigatório"
			},
			'data[Item][description]':{
				required: "Campo obrigatório"
			}
		}
	}); 
	
});
</script>

<div class="items form">
<?php echo $this->Form->create('Item', array('type'=>'file'));?>
	<fieldset>
		<legend><?php echo __('Editar Item'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('item_class_id', array('label'=>__('Classe do item')));
		echo $this->Form->input('pngc_code_id', array('label'=>__('PNGC')));
		echo $this->Form->input('name', array('label'=>__('Nome')));
		echo $this->Form->input('description', array('label'=>__('Descrição')));
		echo $this->Form->input('image_path', array('label'=>__('Imagem'), 'type'=>'file'));
		echo '<p>Imagem atual: </p>';
		echo $this->Html->image('items'.DS.$this->request->data['Item']['image_path']); 
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Alterar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Deletar item'), array('action' => 'delete', $this->Form->value('Item.id')), null, __('Deseja realmente deletar o item #%s?', $this->Form->value('Item.name'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Itens'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar classes dos itens'), array('controller' => 'item_classes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova classe do item'), array('controller' => 'item_classes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar PNGCs'), array('controller' => 'pngc_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo código PNGC'), array('controller' => 'pngc_codes', 'action' => 'add')); ?> </li>
	</ul>
</div>
