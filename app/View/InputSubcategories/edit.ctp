<div class="inputSubcategories form">
<?php echo $this->Form->create('InputSubcategory');?>
	<fieldset>
		<legend><?php echo __('Edit Input Subcategory'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('InputSubcategory.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('InputSubcategory.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Input Subcategories'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Inputs'), array('controller' => 'inputs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Input'), array('controller' => 'inputs', 'action' => 'add')); ?> </li>
	</ul>
</div>
