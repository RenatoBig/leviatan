<div class="span2">
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Unidades setores'), array('controller'=>'unity_sectors', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('Unidades'), array('controller'=>'unities', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('Funcionários'), array('controller'=>'employees', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('Setores'), array('controller'=>'sectors', 'action' => 'index')); ?></li>
		</ul>
	</div>
</div>

<div class="span4 well">
	<h2><?php  echo __('Unidade_setor');?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($unitySector['UnitySector']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unidade'); ?></dt>
		<dd>
			<?php echo $this->Html->link($unitySector['Unity']['name'], array('controller' => 'unities', 'action' => 'view', $unitySector['Unity']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Setor'); ?></dt>
		<dd>
			<?php echo $this->Html->link($unitySector['Sector']['name'], array('controller' => 'sectors', 'action' => 'view', $unitySector['Sector']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Criado'); ?></dt>
		<dd>
			<?php echo h($unitySector['UnitySector']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($unitySector['UnitySector']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
