<div class="span2">	
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Regiões'), array('action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('Áreas'), array('controller'=>'areas','action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('Cidades'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Unidades'), array('controller' => 'unities', 'action' => 'index')); ?> </li>
		</ul>
	</div>
</div>

<div class="span4">
	<h2><?php  echo __('Região');?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($region['Region']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cidade'); ?></dt>
		<dd>
			<?php echo $this->Html->link($region['City']['name'], array('controller' => 'cities', 'action' => 'view', $region['City']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Área'); ?></dt>
		<dd>
			<?php echo $this->Html->link($region['Area']['name'], array('controller' => 'areas', 'action' => 'view', $region['Area']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Criado'); ?></dt>
		<dd>
			<?php echo h($region['Region']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($region['Region']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
