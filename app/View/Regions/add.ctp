<div class="span9 well">
	<?php echo $this->Form->create('Region');?>
		<fieldset>
			<legend><?php echo __('Adicionar região'); ?></legend>
		<?php
			echo $this->Form->input('city_id', array('label'=>__('Cidade'), 'onChange'=>'selectFill("areas", "get_areas", options[selectedIndex].value)'));
			echo $this->Form->button('Nova cidade', array('class'=>'btnCallFormAdd btn', 'type'=>'button', 'value'=>'cities'));
			echo '<div id="input_area">';
			echo $this->Form->input('area_id', array('label'=>__('Área'), 'name'=>'data[Region][area_id][0]', 'id'=>'select_child'));
			echo '</div>';
			echo $this->Html->link(
					$this->Html->image("add.png", array("alt"=>"Adicionar área")),
					"javascript:void(0)",
					array(
						'id'=>'newSelectArea', 
						'escape' => false
					)
			);
			echo $this->Form->button('Nova área', array('class'=>'btnCallFormAdd btn', 'type'=>'button', 'value'=>'areas'));
			
			echo '<div id="boxFields">';			
			echo '</div>';
		?>
		</fieldset>
		<a href="javascript:void(0)" class="btn btn-primary" onclick='submit("Region", "regions")'>Cadastrar</a>
		<?php echo $this->Html->link(__('Cancelar'), array('controller'=>'regions', 'action'=>'index'), array('class'=>'btn', 'title'=>__('Cancelar')));?>
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