<div class="span2">	
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Itens'), array('action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('PNGC'), array('controller' => 'pngc_codes', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Classe do item'), array('controller' => 'item_classes', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Pedidos'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		</ul>
	</div>
</div>

<div class="span4">
<?php echo $this->Form->create('Item', array('type'=>'file', 'class'=>'well'));?>
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
