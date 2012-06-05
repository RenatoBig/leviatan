<div class="employees form">
<?php echo $this->Form->create('Employee');?>
	<fieldset>
		<legend><?php echo __('Edit Employee'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('registration');
		echo $this->Form->input('name');
		echo $this->Form->input('birth_date');
		echo $this->Form->input('email');
		echo $this->Form->input('phone');
		echo $this->Form->input('rg');
		echo $this->Form->input('cpf');
		echo $this->Form->input('voter_card');
		echo $this->Form->input('ctps');
		echo $this->Form->input('reservist');
		echo $this->Form->input('agency');
		echo $this->Form->input('account');
		echo $this->Form->input('unity_sector_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Employee.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Employee.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Employees'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Unity Sectors'), array('controller' => 'unity_sectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unity Sector'), array('controller' => 'unity_sectors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
