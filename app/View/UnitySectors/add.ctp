<div class="span9 well">
<?php echo $this->Form->create('UnitySector');?>
	<fieldset>
		<legend><?php echo __('Adicionar setores na unidade'); ?></legend>
	<?php
		
		echo $this->Form->input('unity_id', array('label'=>__('Unidade'), 'onChange'=>'selectFill("sectors", "get_sectors", options[selectedIndex].value)'));
		echo $this->Form->button('Nova unidade', array('class'=>'btnCallFormAdd btn', 'type'=>'button', 'value'=>'unities'));
		echo '<div id="select_sector">';
			echo $this->Form->input('sector_id', array('label'=>__('Setor'), 'name'=>'data[UnitySector][sector_id][0]', 'id'=>'select_child'));
		echo '</div>';
		echo $this->Html->link(
				$this->Html->image("add.png", array("alt" => "Novo setor")),
				"javascript:void(0)",
				array(
					'id'=>'newSelectUnitySector', 
					'escape' => false
				)
		);
		echo $this->Form->button('Novo setor', array('class'=>'btnCallFormAdd btn', 'type'=>'button'));
		
		echo '<div id="boxFields">';
		echo '</div>';
	?>
	</fieldset>
	<a href="javascript:void(0)" class="btn btn-primary" onclick='submit("UnitySector", "unity_sectors")'>Cadastrar</a>
	<?php echo $this->Html->link(__('Cancelar'), array('controller'=>'unity_sectors', 'action'=>'index'), array('class'=>'btn', 'title'=>__('Cancelar')));?>
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