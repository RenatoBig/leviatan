<?php echo $this->Html->script(array('validate'));?>
<div class="well">
<?php echo $this->Form->create('InputSubcategory');?>
	<fieldset>
		<legend><?php echo __('Adicionar subcategoria de insumo'); ?></legend>
	<?php
		echo $this->Form->input('name', array('label'=>__('Nome'), 'class'=>'span14'));
		echo $this->Form->input('description', array('label'=>__('Descrição'), 'class'=>'span14', 'rows'=>'4'));
	?>
	</fieldset>
	<?php echo $this->Form->button(__('Cadastrar'), array('class'=>'btn btn-primary', 'title'=>__('Cadastrar subcategoria')));?>
	<?php echo $this->Html->link(__('Cancelar'), array('#'), array('class'=>'btn', 'title'=>__('Cancelar'), 'data-dismiss'=>'modal', 'aria-hidden'=>'true'))?>
<?php echo $this->Form->end();?>
</div>
