<div class="span2">	
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Cidades'), array('action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('Áreas'), array('controller' => 'areas', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Regioẽs'), array('controller' => 'regions', 'action' => 'index')); ?> </li>
		</ul>
	</div>
</div>

<div class="span4 well">
	<h2><?php  echo __('Cidade');?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($city['City']['id']); ?>
		</dd>
		<dt><?php echo __('Código'); ?></dt>
		<dd>
			<?php echo h($city['City']['keycode']); ?>
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($city['City']['name']); ?>
		</dd>
		<dt><?php echo __('Criado'); ?></dt>
		<dd>
			<?php echo h($city['City']['created']); ?>
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($city['City']['modified']); ?>
		</dd>
	</dl>
</div>
