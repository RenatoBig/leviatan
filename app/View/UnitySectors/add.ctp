<div class="span2">
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Unidades setores'), array('controller'=>'unity_sectors', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('Unidades'), array('controller'=>'unities', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('Funcionários'), array('controller'=>'employees', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('Setores'), array('controller'=>'sectors', 'action' => 'index')); ?></li>
		</ul>
	</div>
</div>

<div class="span4">
<?php echo $this->Form->create('UnitySector', array('class'=>'well'));?>
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
<?php echo $this->Form->end(array('label'=>__('Cadastrar'), 'class'=>'btn btn-primary'));?>
</div>
