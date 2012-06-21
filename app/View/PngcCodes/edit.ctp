<script>
$(document).ready(function() {
	
	$('#PngcCodeInputCategoryId').change(function() {
		if($(this).val() == 0) {
			$('#PngcCodeInputSubcategoryId').parent().hide('slow');
		}else {
			$('#PngcCodeInputSubcategoryId').parent().show('slow');
		}
	});	

	//validação de formulário
	$("#PngcCodeEditForm").validate({ 
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
		<legend><?php echo __('Edit Pngc Code'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('keycode', array('label'=>'Código'));
		echo $this->Form->input('expense_group_id', array('label'=>'Grupo de gastos'));
		echo $this->Form->input('functional_unit_id', array('label'=>'Unidade funcional'));		
		echo $this->Form->input('measure_type_id', array('label'=>'Tipo de medida'));
		echo $this->Form->input('input_category_id', array('label'=>__('Categoria de insumo'),'value'=>$this->request->data['Input']['input_category_id']));
		echo $this->Form->input('input_subcategory_id', array('label'=>__('Subcategoria de insumo'), 'value'=>$this->request->data['Input']['input_subcategory_id']));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Alterar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Deletar PNGC'), array('action' => 'delete', $this->Form->value('PngcCode.id')), null, __('Deseja realmente deletar o PNGC #%s?', $this->Form->value('PngcCode.keycode'))); ?></li>
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
