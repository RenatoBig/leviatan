<div class="span9 well">
<?php echo $this->Form->create('PngcCode');?>
	<fieldset>
		<legend><?php echo __('Edit Pngc Code'); ?></legend>
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('keycode', array('label'=>'Código'));
		echo $this->Form->input('expense_group_id', array('label'=>'Grupo de gastos'));
		echo $this->Form->input('input_category_id', array('label'=>__('Categoria de insumo'),'value'=>$this->request->data['Input']['input_category_id'], 'id'=>'select_category_pngc'));
		echo $this->Form->input('input_subcategory_id', array('label'=>__('Subcategoria de insumo'), 'value'=>$this->request->data['Input']['input_subcategory_id'],'id'=>'select_subcategory_pngc'));
		echo $this->Form->input('measure_type_id', array('label'=>'Tipo de medida'));
		?>
	</fieldset>
	<?php echo $this->Form->button(__('Alterar'), array('class'=>'btn btn-primary', 'title'=>__('Alterar PNGC')));?>
	<?php echo $this->Html->link(__('Cancelar'), array('controller'=>'pngc_codes', 'action'=>'index'), array('class'=>'btn', 'title'=>__('Cancelar')));?>
<?php echo $this->Form->end();?>
</div>
