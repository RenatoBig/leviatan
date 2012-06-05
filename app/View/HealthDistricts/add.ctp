<div class="healthDistricts form">
<?php echo $this->Form->create('HealthDistrict');?>
	<fieldset>
		<legend><?php echo __('Add Health District'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Health Districts'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Unities'), array('controller' => 'unities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unity'), array('controller' => 'unities', 'action' => 'add')); ?> </li>
	</ul>
</div>
