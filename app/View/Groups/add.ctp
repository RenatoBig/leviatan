<div class="span9 well">
	<?php echo $this->Form->create('Group');?>
		<fieldset>
			<legend><?php echo __('Adicionar grupo'); ?></legend>
			<div class="control-group">
				<?php
				echo $this->Form->input('name', array('label'=>__('Nome'), 'class'=>'control-label'));
				?>
			</div>
		</fieldset>
		<?php echo $this->Form->button(__('Cadastrar'), array('class'=>'btn btn-primary', 'title'=>__('cadastrar grupo')));?>
	<?php echo $this->Html->link(__('Cancelar'), array('controller'=>'groups', 'action'=>'index'), array('class'=>'btn', 'title'=>__('Cancelar')))?>
<?php echo $this->Form->end();?>
</div>
