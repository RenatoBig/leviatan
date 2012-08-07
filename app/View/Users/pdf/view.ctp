<div class="span2">
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Usuários'), array('action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('Grupos'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Funcionários'), array('controller' => 'employees', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Pedidos'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		</ul>
	</div>
</div>

<div class="span6 well">
	<h2><?php  echo __('Usuário');?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
		</dd>
		<dt><?php echo __('Funcionário'); ?></dt>
		<dd>
			<?php echo h($user['Employee']['name']); ?>
		</dd>
		<dt><?php echo __('Usuário'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
		</dd>
		<dt><?php echo __('Senha'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
		</dd>
		<dt><?php echo __('Grupo'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?>
		</dd>
		<dt><?php echo __('Criado'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($user['User']['modified']); ?>
		</dd>
	</dl>
</div>
