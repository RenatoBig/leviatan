<div class="span2">
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Distritos sanitários'), array('action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('Unidades'), array('controller'=>'unities', 'action' => 'index')); ?></li>
		</ul>
	</div>
</div>

<div class="span4 well">
	<h2><?php  echo __('Health District');?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($healthDistrict['HealthDistrict']['id']); ?>
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($healthDistrict['HealthDistrict']['name']); ?>
		</dd>
		<dt><?php echo __('Criado'); ?></dt>
		<dd>
			<?php echo h($healthDistrict['HealthDistrict']['created']); ?>
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($healthDistrict['HealthDistrict']['modified']); ?>
		</dd>
	</dl>
</div>
