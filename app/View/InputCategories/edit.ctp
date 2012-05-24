<div class="inputCategories form">
<?php echo $this->Form->create('InputCategory');?>
	<fieldset>
		<legend><?php echo __('Edit Input Category'); ?></legend>
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('InputCategory.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('InputCategory.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Input Categories'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Input Subcategories'), array('controller' => 'input_subcategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Input Subcategory'), array('controller' => 'input_subcategories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pngc Codes'), array('controller' => 'pngc_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pngc Code'), array('controller' => 'pngc_codes', 'action' => 'add')); ?> </li>
	</ul>
</div>
