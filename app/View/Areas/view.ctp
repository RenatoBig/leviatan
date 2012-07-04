<div class="span2">	
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Áreas'), array('action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('Cidades'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Regioẽs'), array('controller' => 'regions', 'action' => 'index')); ?> </li>
		</ul>
	</div>
</div>

<div class="span4">
	<h2><?php  echo __('Area');?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($area['Area']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($area['Area']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Criado'); ?></dt>
		<dd>
			<?php echo h($area['Area']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($area['Area']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
