<div class="span9 well">
<?php echo $this->Form->create('Input');?>
	<fieldset>
		<legend><?php echo __('Adicionar insumo'); ?></legend>
	<?php
		echo $this->Form->input('input_category_id', array('label'=>__('Categoria'), 'onChange'=>'selectFill("input_subcategories", "get_subcategories", options[selectedIndex].value)'));
		echo $this->Form->button('Nova categoria', array('class'=>'btnCallFormAdd btn', 'type'=>'button', 'value'=>'input_categories'));
		echo '<div id="input_subcategory">';
			echo $this->Form->input('input_subcategory_id', array('label'=>__('Subcategoria'), 'options'=>array(''=>'Selecione uma categoria'), 'name'=>'data[Input][input_subcategory_id][0]', 'id'=>'select_child'));
		echo '</div>';
		echo $this->Html->link(
				$this->Html->image("add.png", array("alt" => "Nova subcategoria")),
				"javascript:void(0)",
				array(
					'id'=>'newSelectInput', 
					'escape' => false
				)
		);
		echo $this->Form->button('Nova subcategoria', array('class'=>'btnCallFormAdd btn', 'type'=>'button', 'value'=>'input_subcategories'));
		
		echo '<div id="boxFields">';		
		echo '</div>';
	?>
	</fieldset>
	<a href="javascript:void(0)" class="btn btn-primary" onclick='submit("Input", "inputs")'>Cadastrar</a>
	<?php echo $this->Html->link(__('Cancelar'), array('controller'=>'inputs', 'action'=>'index'), array('class'=>'btn', 'title'=>__('Cancelar')))?>
<?php echo $this->Form->end();?>
</div>
<div class="modal hide fade" id="modal-category">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Novo</h3>
  </div>
  <div class="modal-body">
  </div>
  <div class="modal-footer">
  </div>
</div>
