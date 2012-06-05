<div class="items form">
<?php echo $this->Form->create('Item');?>
	<fieldset>
		<legend><?php echo __('Add Item'); ?></legend>
	<?php
		echo $this->Form->input('item_class_id');
		echo $this->Form->input('pngc_code_id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('image_path');
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
