<script>
$(document).ready(function() {

	//Combobox
	$('#PngcCodeInputSubcategoryId').parent().hide();
	
	$('#PngcCodeInputCategoryId').change(function() {
		if($(this).val() == 0) {
			$('#PngcCodeInputSubcategoryId').parent().hide('slow');
		}else {
			$('#PngcCodeInputSubcategoryId').parent().show('slow');
		}
	});	

	//validação de formulário
	$("#PngcCodeAddForm").validate({ 
    	rules: { 
			'data[PngcCode][keycode]':{
				required: true,
			},
			'data[PngcCode][expense_group_id]':{
				required: true
			},
			'data[PngcCode][functional_unit_id]':{
				required: true
			},
			'data[PngcCode][input_category_id]':{
				required: true
			},
			'data[PngcCode][input_subcategory_id]':{
				required: true
			},
			'data[PngcCode][measure_type_id]':{
				required: true
			}
		},
		messages: {
			'data[PngcCode][keycode]':{
				required: "Este campo é obrigatório",
			},
			'data[PngcCode][expense_group_id]':{
				required: "Este campo é obrigatório"
			},
			'data[PngcCode][functional_unit_id]':{
				required: "Este campo é obrigatório"
			},
			'data[PngcCode][input_category_id]':{
				required: "Este campo é obrigatório"
			},
			'data[PngcCode][input_subcategory_id]':{
				required: "Este campo é obrigatório"
			},
			'data[PngcCode][measure_type_id]':{
				required: "Este campo é obrigatório"
			}
		}
	}); 
	
});
</script>

<div class="pngcCodes form">
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
		echo $this->Form->input('functional_unit_id', array('label'=>__('Unidade funcional')));		
		echo $this->Form->input('measure_type_id', array('label'=>__('Tipo de medida')));
		echo $this->Form->input('input_category_id', array('label'=>__('Categoria de insumo')));
		echo $this->Form->input('input_subcategory_id', array('label'=>__('Subcategoria de insumo')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Cadastrar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Listar PNGCs'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar Grupos de gastos'), array('controller' => 'expense_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo grupo de gastos'), array('controller' => 'expense_groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar unidades funcionais'), array('controller' => 'functional_units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova unidade funcional'), array('controller' => 'functional_units', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar categorias de insumos'), array('controller' => 'input_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova categoria de insumo'), array('controller' => 'input_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar subcategorias de insumos'), array('controller' => 'input_subcategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova subcategoria de insumos '), array('controller' => 'input_subcategories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar tipos de medidas'), array('controller' => 'measure_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo tipo de medida'), array('controller' => 'measure_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar itens'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
