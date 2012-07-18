<div class="cartItems view">
<h2><?php  echo __('Cart Item'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($cartItem['CartItem']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($cartItem['User']['id'], array('controller' => 'users', 'action' => 'view', $cartItem['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item'); ?></dt>
		<dd>
			<?php echo $this->Html->link($cartItem['Item']['name'], array('controller' => 'items', 'action' => 'view', $cartItem['Item']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($cartItem['CartItem']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($cartItem['CartItem']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Cart Item'), array('action' => 'edit', $cartItem['CartItem']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Cart Item'), array('action' => 'delete', $cartItem['CartItem']['id']), null, __('Are you sure you want to delete # %s?', $cartItem['CartItem']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Cart Items'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cart Item'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
