<div class="items form">
<?php echo $this->Form->create('Item');?>
	<fieldset>
		<legend><?php echo __('Add Item'); ?></legend>
	<?php
		echo $this->Form->input('GroupType', array('id'=>'groupTypes'));
		
		//requisição ajax para popular o select do ItemGroups
		$this->Js->get('#groupTypes')->event('change', 
			$this->Js->request(
				array(
					'controller'=>'ItemGroups',
					'action'=>'getByCategory'
				), 
				array(
					'update'=>'#itemGroups',
					'async' => true,
					'method' => 'post',
					'dataExpression'=>true,
					'data'=> $this->Js->serializeForm(array(
						'isForm' => true,
						'inline' => true
					))
				)
			)				
		);
		
		echo $this->Form->input('ItemGroup', array('id'=>'itemGroups', 'type'=>'select'));
		
		$this->Js->get('#itemGroups')->event('change', 
			$this->Js->request(
				array(
					'controller'=>'ItemClasses',
					'action'=>'getByCategory'
				), 
				array(
					'update'=>'#itemClasses',
					'async' => true,
					'method' => 'post',
					'dataExpression'=>true,
					'data'=> $this->Js->serializeForm(array(
						'isForm' => true,
						'inline' => true
					))
				)
			)				
		);
		echo $this->Form->input('ItemClass', array('id'=>'itemClasses', 'type'=>'select'));
		
		echo $this->Form->input('pngc_code_id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Items'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Item Classes'), array('controller' => 'item_classes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item Class'), array('controller' => 'item_classes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pngc Codes'), array('controller' => 'pngc_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pngc Code'), array('controller' => 'pngc_codes', 'action' => 'add')); ?> </li>
	</ul>
</div>
