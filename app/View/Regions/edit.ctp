<div class="regions form">
<?php echo $this->Form->create('Region');?>
	<fieldset>
		<legend><?php echo __('Edit Region'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('city_id');
		echo $this->Form->input('area_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Region.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Region.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Regions'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Areas'), array('controller' => 'areas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Area'), array('controller' => 'areas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Unities'), array('controller' => 'unities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unity'), array('controller' => 'unities', 'action' => 'add')); ?> </li>
	</ul>
</div>
