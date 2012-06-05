<div class="sectors form">
<?php echo $this->Form->create('Sector');?>
	<fieldset>
		<legend><?php echo __('Edit Sector'); ?></legend>
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Sector.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Sector.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Sectors'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Unity Sectors'), array('controller' => 'unity_sectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unity Sector'), array('controller' => 'unity_sectors', 'action' => 'add')); ?> </li>
	</ul>
</div>
