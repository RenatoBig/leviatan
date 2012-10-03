<div class="span9 well">
	<?php		
	echo $this->Form->create('SolicitationItem', array('class'=>'well'));
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
		echo '<fieldset>';
			echo $this->Form->input('item_group_id', array('label'=>'Grupo', 'type'=>'select', 'options'=>$groups, 'class'=>'input-xxlarge', 'id'=>'item-group-id'));
			echo $this->Form->input('item_class_id', array('label'=>'Classe', 'type'=>'select', 'options'=>array(''=>'Selecione um grupo'), 'class'=>'input-xxlarge', 'id'=>'item-class-id'));
			echo $this->Form->input('name', array('label'=>__('Nome'), 'class'=>'input-xxlarge', 'id'=>'search-item'));
		echo '</fieldset>';

		echo $this->Form->button(__('Filtrar'), array('id'=>'filter', 'value'=>'solicitation_items', 'class'=>'btn btn-primary', 'title'=>__('Filtrar'), 'type'=>'button'));
	echo $this->Form->end();	
	?>

	<div id="html">		
		<?php echo $this->element('solicitation_items_index_ajax')?>
	</div>
</div>
