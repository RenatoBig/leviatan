
<div class="span9 well">
<?php echo $this->Form->create('Input');?>
	<fieldset>
		<legend><?php echo __('Adicionar insumo'); ?></legend>
	<?php
		//requisição feita quando se muda a categoria. Como resposta ele popula o select
		//das subcategorias com as que ainda não foram cadastradas 
		//-------------------
		$this->Js->get('#InputInputCategoryId')->event('change', 
			$this->Js->request(
				array(
					'controller'=>'InputSubcategories',
					'action'=>'getSubcategories'
				), 
				array(
					'update'=>'#InputInputSubcategoryId',
					'async' => true,
					'method' => 'post',
					'dataExpression'=>true,
					'data'=> $this->Js->serializeForm(
						array(
							'isForm' => true,
							'inline' => true
						)
					)
				)
			)
		);		
		//----------------------
	
		echo $this->Form->input('input_category_id', array('label'=>__('Categoria')));
		echo $this->Form->input('input_subcategory_id', array('label'=>__('Subcategoria')));
	?>
	</fieldset>
	<?php echo $this->Form->button(__('Cadastrar'), array('class'=>'btn btn-primary', 'title'=>__('Cadastrar insumo')));?>
	<?php echo $this->Html->link(__('Cancelar'), array('controller'=>'inputs', 'action'=>'index'), array('class'=>'btn', 'title'=>__('Cancelar')))?>
<?php echo $this->Form->end();?>
</div>
