<div class="itemClasses form">
<?php echo $this->Form->create('ItemClass');?>
	<fieldset>
		<legend><?php echo __('Add Item Class'); ?></legend>
	<?php
		echo $this->Form->input('item_group_id');
		echo $this->Form->input('keycode');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Item Classes'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Item Groups'), array('controller' => 'item_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item Group'), array('controller' => 'item_groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
