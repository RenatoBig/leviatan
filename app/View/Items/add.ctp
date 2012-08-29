<div class="span9 well">
	<?php echo $this->Form->create('Item', array('type'=>'file', 'class'=>'well'));?>
		<fieldset>
			<legend><?php echo __('Adicionar Item'); ?></legend>
		<?php
			echo $this->Form->input('item_group_id', array('label'=>__('Grupo do item'), 'class'=>'input-xxlarge'));
			echo $this->Form->input('item_class_id', array('label'=>__('Classe do item'), 'class'=>'input-xxlarge'));
			echo $this->Form->input('pngc_code_id', array('label'=>__('PNGC'), 'class'=>'input-xxlarge'));
			echo $this->Form->input('keycode', array('label'=>__('Código'), 'class'=>'input-small'));
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

<?php 
//requisição feita quando se muda a o grupo do item. Como resposta ele popula o select
//das classes 
//-------------------
$this->Js->get('#ItemItemGroupId')->event('change',
	$this->Js->request(
		array(
			'controller'=>'ItemClasses',
			'action'=>'get_by_category'
		),
		array(
			'update'=>'#ItemItemClassId',
			'async' => true,
			'method' => 'post',
			'dataExpression'=>true,
			'data'=> $this->Js->serializeForm(
				array(
					'isForm' => true,
					'inline' => true
				)
			),
		)
	)
);
//----------------------
?>
