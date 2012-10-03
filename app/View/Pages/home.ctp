<div class="span9 well">
	<?php 
	//requisição feita quando se muda a categoria. Como resposta ele popula o select
	//das subcategorias com as que ainda não foram cadastradas
	//-------------------
	$this->Js->get('#item-group-id')->event('change',
		$this->Js->request(
			array(
				'controller'=>'solicitation_items',
				'action'=>'get_classes'
			),
			array(
				'update'=>'#item-class-id',
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
	echo $this->Form->create('Pages', array('class'=>'well'));
		echo '<fieldset>';
			echo $this->Form->input('item_group_id', array('label'=>__('Grupo do item'), 'class'=>'input-xxlarge', 'options'=>$groups, 'id'=>'item-group-id'));
			echo $this->Form->input('item_class_id', array('label'=>__('Classe do item'), 'class'=>'input-xxlarge', 'options'=>array(''=>'Selecione um grupo'), 'id'=>'item-class-id'));
			echo $this->Form->input('name', array('label'=>__('Nome'), 'class'=>'input-xxlarge', 'id'=>'search-item'));
		echo '</fieldset>';
		echo $this->Form->button(__('Filtrar'), array('id'=>'filter', 'value'=>'pages', 'class'=>'btn btn-primary', 'title'=>__('Filtrar item'), 'type'=>'button'));
				
	echo $this->Form->end();
	?>
	<div id="html">	
		<?php echo $this->element('pages_home_ajax');?>
	</div>
</div>