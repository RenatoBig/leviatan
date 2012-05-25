<div class="itemClasses view">
<h2><?php  echo __('Item Class');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($itemClass['ItemClass']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($itemClass['ItemGroup']['name'], array('controller' => 'item_groups', 'action' => 'view', $itemClass['ItemGroup']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Keycode'); ?></dt>
		<dd>
			<?php echo h($itemClass['ItemClass']['keycode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($itemClass['ItemClass']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Item Class'), array('action' => 'edit', $itemClass['ItemClass']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Item Class'), array('action' => 'delete', $itemClass['ItemClass']['id']), null, __('Are you sure you want to delete # %s?', $itemClass['ItemClass']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Item Classes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item Class'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Item Groups'), array('controller' => 'item_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item Group'), array('controller' => 'item_groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
