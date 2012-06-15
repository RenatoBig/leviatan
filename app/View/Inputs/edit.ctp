<script type="text/javascript">
$(document).ready(function() {

	$('#InputInputCategoryId').change(function() {
		if($(this).val() == 0) {
			$('#InputInputSubcategoryId').parent().hide('slow');
		}else {
			$('#InputInputSubcategoryId').parent().show('slow');
		}
	});	

	//Função que retira o nome da subcategoria atual quando clica no select da subcategoria
	$('#InputInputSubcategoryId').click(function() {
		var category = '<?php echo $this->request->data['InputCategory']['id']?>';
		var subcategory = '<?php echo $this->request->data['InputSubcategory']['id']?>';

		var categorySelect = document.getElementById("InputInputCategoryId");
		var subcategorySelect = document.getElementById("InputInputSubcategoryId");
		
		if(subcategorySelect.value == subcategory && categorySelect.value == category) {
			subcategorySelect.remove(subcategorySelect.selectedIndex);
		}		
	});

	//validação de formulário
	$("#InputEditForm").validate({ 
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
		<legend><?php echo __('Editar insumo'); ?></legend>
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
		echo $this->Form->input('id');
		echo $this->Form->input('input_category_id', array('label'=>__('Categoria')));
		echo $this->Form->input('input_subcategory_id', array('label'=>__('Subcategoria')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Alterar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Deletar insumo'), array('action' => 'delete', $this->Form->value('Input.id')), null, __('Deseja realmente deletar o insumo #%s?', $this->Form->value('Input.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar insumos'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar categorias'), array('controller' => 'input_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova categoria'), array('controller' => 'input_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar subcategorias'), array('controller' => 'input_subcategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova subcategoria'), array('controller' => 'input_subcategories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar PNGCs'), array('controller' => 'pngc_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo PNGC'), array('controller' => 'pngc_codes', 'action' => 'add')); ?> </li>
	</ul>
</div>
