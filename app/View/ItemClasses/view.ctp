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
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($itemClass['ItemClass']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($itemClass['ItemClass']['modified']); ?>
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
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Items');?></h3>
	<?php if (!empty($itemClass['Item'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Item Class Id'); ?></th>
		<th><?php echo __('Pngc Code Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Image Path'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($itemClass['Item'] as $item): ?>
		<tr>
			<td><?php echo $item['id'];?></td>
			<td><?php echo $item['item_class_id'];?></td>
			<td><?php echo $item['pngc_code_id'];?></td>
			<td><?php echo $item['name'];?></td>
			<td><?php echo $item['description'];?></td>
			<td><?php echo $item['image_path'];?></td>
			<td><?php echo $item['created'];?></td>
			<td><?php echo $item['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'items', 'action' => 'view', $item['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'items', 'action' => 'edit', $item['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'items', 'action' => 'delete', $item['id']), null, __('Are you sure you want to delete # %s?', $item['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
