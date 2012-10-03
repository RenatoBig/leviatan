<div class="span9 well">
	<?php echo $this->Form->create('Item', array('type'=>'file', 'class'=>'well'));?>
		<fieldset>
			<legend><?php echo __('Adicionar Item'); ?></legend>
		<?php
			echo $this->Form->input('item_group_id', array('label'=>__('Grupo do item'), 'class'=>'input-xxlarge', 'onChange'=>'selectFill("item_classes", "get_categories", options[selectedIndex].value)'));
			echo $this->Form->input('item_class_id', array('label'=>__('Classe do item'), 'class'=>'input-xxlarge', 'id'=>'select_child'));
			echo $this->Form->input('pngc_code_id', array('label'=>__('PNGC'), 'class'=>'input-xxlarge'));
			echo $this->Form->input('name', array('label'=>__('Nome')));		
			echo $this->Form->input('description', array('label'=>__('Descrição')));
			echo $this->Fck->load('ItemDescription');
			echo $this->Form->input('specification', array('label'=>__('Especificação')));
			echo $this->Fck->load('ItemSpecification');
			echo $this->Form->input('image_path', array('label'=>__('Imagem'), 'type'=>'file'));
		?>
		</fieldset>
		<?php echo $this->Form->button(__('Cadastrar'), array('class'=>'btn btn-primary', 'title'=>__('Cadastrar item')));?>
		<?php echo $this->Html->link('Cancelar', array('controller'=>'items', 'action'=>'index'), array('class'=>'btn', 'title'=>'Cancelar'));?>
	<?php echo $this->Form->end();?>
</div>