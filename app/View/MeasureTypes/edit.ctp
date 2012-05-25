<div class="measureTypes form">
<?php echo $this->Form->create('MeasureType');?>
	<fieldset>
		<legend><?php echo __('Edit Measure Type'); ?></legend>
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('MeasureType.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('MeasureType.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Measure Types'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Pngc Codes'), array('controller' => 'pngc_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pngc Code'), array('controller' => 'pngc_codes', 'action' => 'add')); ?> </li>
	</ul>
</div>
