<script type="text/javascript">
$(document).ready(function() {

	//Combobox
	$('#InputInputSubcategoryId').parent().hide();
	
	$('#InputInputCategoryId').change(function() {
		if($(this).val() == 0) {
			$('#InputInputSubcategoryId').parent().hide('slow');
		}else {
			$('#InputInputSubcategoryId').parent().show('slow');
		}
	});	

	//validação de formulário
	$("#InputAddForm").validate({ 
    	rules: { 			
			'data[Input][input_category_id]':{
				required: true
			},
			'data[Input][input_subcategory_id]':{
				required: true
			}
		},
		messages: {
			'data[Input][input_category_id]':{
				required: "Campo obrigatório"
			},
			'data[Input][input_subcategory_id]':{
				required: "Campo obrigatório"
			}
		}
	}); 
	
});
</script>

<div class="inputs form">
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
<?php echo $this->Form->end(__('Cadastrar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Listar insumos'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar categorias'), array('controller' => 'input_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova categoria'), array('controller' => 'input_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar subcategorias'), array('controller' => 'input_subcategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova subcategoria'), array('controller' => 'input_subcategories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar PNGCs'), array('controller' => 'pngc_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo PNGC'), array('controller' => 'pngc_codes', 'action' => 'add')); ?> </li>
	</ul>
</div>
