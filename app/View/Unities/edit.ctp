<div class="span2">
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Unidades'), array('action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('Tipos das unidades'), array('controller'=>'unity_types', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('Distritos sanitários'), array('controller'=>'health_districts', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('Unidades setor'), array('controller'=>'unity_sectors', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('Regiões'), array('controller'=>'regions', 'action' => 'index')); ?></li>
		</ul>
	</div>
</div>

<div class="span4">
<?php echo $this->Form->create('Unity', array('class'=>'well'));?>
	<fieldset>
		<legend><?php echo __('Editar unidade'); ?></legend>
	<?php
		//requisição feita quando se muda a cidade. Como resposta ele popula o select
		//das áreas de acordo com a cidade escolhida 
		//-------------------
		$this->Js->get('#UnityCityId')->event('change', 
			$this->Js->request(
				array(
					'controller'=>'Regions',
					'action'=>'getAreas'
				), 
				array(
					'update'=>'#UnityRegionId',
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
		echo $this->Form->input('cnes', array('label'=>__('CNES')));
		echo $this->Form->input('cnpj', array('label'=>__('CNPJ')));
		echo $this->Form->input('name', array('label'=>__('Nome')));
		echo $this->Form->input('trade_name', array('label'=>__('Nome fantasia')));
		echo $this->Form->input('address', array('label'=>__('Endereço')));
		echo $this->Form->input('number', array('label'=>__('Número'), 'class'=>'input-mini'));
		echo $this->Form->input('cep', array('label'=>__('CEP')));
		echo $this->Form->input('phone', array('label'=>__('Telefone')));
		echo $this->Form->input('fax', array('label'=>__('FAX')));
		echo $this->Form->input('city_id', array('label'=>__('Cidade'), 'value'=>$this->request->data['Region']['city_id']));
		echo $this->Form->input('region_id', array('label'=>__('Área'), 'options'=>$newAreas, 'value'=>$this->request->data['Region']['id']));
		echo $this->Form->input('health_district_id', array('label'=>__('Distrito sanitário')));
		echo $this->Form->input('unity_type_id', array('label'=>__('Tipo da unidade')));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>__('Alterar'), 'class'=>'btn btn-primary'));?>
</div>
