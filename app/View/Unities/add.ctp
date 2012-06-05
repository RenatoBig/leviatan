<div class="unities form">
<?php echo $this->Form->create('Unity');?>
	<fieldset>
		<legend><?php echo __('Add Unity'); ?></legend>
	<?php
		echo $this->Form->input('cnes');
		echo $this->Form->input('cnpj');
		echo $this->Form->input('name');
		echo $this->Form->input('trade_name');
		echo $this->Form->input('address');
		echo $this->Form->input('number');
		echo $this->Form->input('cep');
		echo $this->Form->input('phone');
		echo $this->Form->input('fax');
		echo $this->Form->input('region_id');
		echo $this->Form->input('health_district_id');
		echo $this->Form->input('unity_type_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Unities'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Regions'), array('controller' => 'regions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Region'), array('controller' => 'regions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Health Districts'), array('controller' => 'health_districts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Health District'), array('controller' => 'health_districts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Unity Types'), array('controller' => 'unity_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unity Type'), array('controller' => 'unity_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Unity Sectors'), array('controller' => 'unity_sectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unity Sector'), array('controller' => 'unity_sectors', 'action' => 'add')); ?> </li>
	</ul>
</div>
