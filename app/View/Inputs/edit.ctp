<div class="span9 well">
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
	<?php echo $this->Form->button(__('Alterar'), array('class'=>'btn btn-primary', 'title'=>__('Alterar insumo')));?>
	<?php echo $this->Html->link(__('Cancelar'), array('controller'=>'inputs', 'action'=>'index'), array('class'=>'btn', 'title'=>__('Cancelar')))?>
<?php echo $this->Form->end();?>
</div>
<script type="text/javascript">
$(document).ready(function() {
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
});
</script>