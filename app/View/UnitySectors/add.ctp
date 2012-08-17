<div class="span9 well">
<?php echo $this->Form->create('UnitySector');?>
	<fieldset>
		<legend><?php echo __('Adicionar unidade_setor'); ?></legend>
	<?php
		//requisição feita quando se muda a cidade. Como resposta ele popula o select
		//das regiões com as que ainda não foram cadastradas 
		//-------------------
		$this->Js->get('#UnitySectorUnityId')->event('change', 
			$this->Js->request(
				array(
					'controller'=>'sectors',
					'action'=>'getSectors'
				), 
				array(
					'update'=>'#UnitySectorSectorId',
					'async' => true,
					'method' => 'post',
					'dataExpression'=>true,
					'data'=> $this->Js->serializeForm(
						array(
							'isForm' => true,
							'inline' => true
						)
					),
				)
			)
		);		
		//----------------------
		
		echo $this->Form->input('unity_id', array('label'=>__('Unidade')));
		echo $this->Form->input('sector_id', array('label'=>__('Setor')));
	?>
	</fieldset>
	<?php echo $this->Form->button(__('Cadastrar'), array('class'=>'btn btn-primary', 'title'=>__('Cadastrar unidade e setor')))?>
	<?php echo $this->Html->link(__('Cancelar'), array('controller'=>'unity_sectors', 'action'=>'index'), array('class'=>'btn', 'title'=>__('Cancelar')));?>
<?php echo $this->Form->end();?>
</div>
