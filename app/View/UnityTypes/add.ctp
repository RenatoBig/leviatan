<div class="span9 well">
	<?php echo $this->Form->create('UnityType');?>
		<fieldset>
			<legend><?php echo __('Adicionar tipo da unidade'); ?></legend>
				<?php echo $this->Form->input('name', array('label'=>__('Nome')));?>
		</fieldset>
		<?php echo $this->Form->button(__('Cadastrar'), array('class'=>'btn btn-primary', 'title'=>__('Cadastrar tipo da unidade')));?>
		<?php echo $this->Html->link(__('Cancelar'), array('controller'=>'unity_types', 'action'=>'index'),array('class'=>'btn', 'title'=>__('Cancelar')));?>
	<?php echo $this->Form->end();?>
</div>

