<div class="span2">	
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Regiões'), array('action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('Áreas'), array('controller'=>'areas','action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('Cidades'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Unidades'), array('controller' => 'unities', 'action' => 'index')); ?> </li>
		</ul>
	</div>
</div>

<div class="span4">
<?php echo $this->Form->create('Region', array('class'=>'well'));?>
	<fieldset>
		<legend><?php echo __('Editar Região'); ?></legend>
	<?php
		//requisição feita quando se muda a cidade. Como resposta ele popula o select
		//das regiões com as que ainda não foram cadastradas 
		//-------------------
		$this->Js->get('#RegionCityId')->event('change', 
			$this->Js->request(
				array(
					'controller'=>'Areas',
					'action'=>'getAreas'
				), 
				array(
					'update'=>'#RegionAreaId',
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
		echo $this->Form->input('id');
		echo $this->Form->input('city_id', array('label'=>__('Cidade')));
		echo $this->Form->input('area_id', array('label'=>__('Área')));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>__('Cadastrar'), 'class'=>'btn btn-primary'));?>
</div>

<script type="text/javascript">
<!--
//Função que retira o nome da área atual quando clica no select da área
$('#RegionEditForm #RegionAreaId').click(function() {
	var cidade = '<?php echo $this->request->data['City']['id']?>';
	var area = '<?php echo $this->request->data['Area']['id']?>';

	var citySelect = document.getElementById("RegionCityId");
	var areaSelect = document.getElementById("RegionAreaId");
	
	if(areaSelect.value == area && citySelect.value == cidade) {
		areaSelect.remove(areaSelect.selectedIndex);
	}		
});
//-->
</script>
