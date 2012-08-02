<?php echo $this->element('menu'); ?>

<div class="span9 well">
<?php echo $this->Form->create('Item', array('type'=>'file', 'class'=>'well'));?>
	<fieldset>
		<legend><?php echo __('Editar Item'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('item_class_id', array('label'=>__('Classe do item')));
		echo $this->Form->input('pngc_code_id', array('label'=>__('PNGC')));
		echo $this->Form->input('name', array('label'=>__('Nome')));
		echo $this->Form->input('description', array('label'=>__('Descrição')));
		echo $this->Fck->load('ItemDescription');
		echo $this->Form->input('specification', array('label'=>__('Especificação')));
		echo $this->Fck->load('ItemSpecification');
		echo $this->Form->input('image_path', array('label'=>__('Imagem'), 'type'=>'file'));
		echo '<p>Imagem atual: </p>';
		if(empty($item['Item']['image_path'])){
			echo $this->Html->image('no-image.gif');
		} else {
			echo $this->Html->image('items'.DS.$item['Item']['image_path']);
		}
		echo $this->Form->input('prev_image', array('type'=>'hidden', 'value'=>$this->request->data['Item']['image_path']));
		
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>__('Alterar'), 'class'=>'btn btn-primary'));?>
</div>
