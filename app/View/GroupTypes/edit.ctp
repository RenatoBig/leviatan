<div class="groupTypes form">
<?php echo $this->Form->create('GroupType');?>
	<fieldset>
		<legend><?php echo __('Edit Group Type'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('GroupType.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('GroupType.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Group Types'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Item Groups'), array('controller' => 'item_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item Group'), array('controller' => 'item_groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
