<div class="itemGroups form">
<?php echo $this->Form->create('ItemGroup');?>
	<fieldset>
		<legend><?php echo __('Edit Item Group'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('group_type_id');
		echo $this->Form->input('key');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ItemGroup.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ItemGroup.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Item Groups'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Group Types'), array('controller' => 'group_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group Type'), array('controller' => 'group_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
