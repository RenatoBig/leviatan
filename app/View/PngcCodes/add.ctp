<div class="span9 well">
<?php echo $this->Form->create('PngcCode');?>
	<fieldset>
		<legend><?php echo __('Adicionar PNGC'); ?></legend>
	<?php
		//requisição feita quando se muda a cidade. Como resposta ele popula o select
		//das regiões com as que ainda não foram cadastradas 
		//-------------------
		$this->Js->get('#PngcCodeInputCategoryId')->event('change', 
			$this->Js->request(
				array(
					'controller'=>'InputSubcategories',
					'action'=>'getSubcategoriesPngcCode'
				), 
				array(
					'update'=>'#PngcCodeInputSubcategoryId',
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
	
		echo $this->Form->input('keycode', array('label'=>__('Código')));
		echo $this->Form->input('expense_group_id', array('label'=>__('Grupo de gastos')));
		//echo $this->Form->input('functional_unit_id', array('label'=>__('Unidade funcional')));		
		echo $this->Form->input('input_category_id', array('label'=>__('Categoria de insumo')));
		echo $this->Form->input('input_subcategory_id', array('label'=>__('Subcategoria de insumo'), 'options'=>array(''=>'Selecione uma categoria')));
		echo $this->Form->input('measure_type_id', array('label'=>__('Tipo de medida')));
	?>
	</fieldset>
	<?php echo $this->Form->button(__('Cadastrar'), array('id'=>'submitPngc', 'class'=>'btn btn-primary', 'type'=>'button' ,'title'=>__('Cadastrar PNGC')));?>
	<?php echo $this->Html->link(__('Cancelar'), array('controller'=>'pngc_codes', 'action'=>'index'), array('class'=>'btn', 'title'=>__('Cancelar')));?>
<?php echo $this->Form->end();?>
</div>
