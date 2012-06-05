<div class="unitySectors form">
<?php echo $this->Form->create('UnitySector');?>
	<fieldset>
		<legend><?php echo __('Edit Unity Sector'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('unity_id');
		echo $this->Form->input('sector_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('UnitySector.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('UnitySector.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Unity Sectors'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Unities'), array('controller' => 'unities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unity'), array('controller' => 'unities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sectors'), array('controller' => 'sectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sector'), array('controller' => 'sectors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Employees'), array('controller' => 'employees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Employee'), array('controller' => 'employees', 'action' => 'add')); ?> </li>
	</ul>
</div>
