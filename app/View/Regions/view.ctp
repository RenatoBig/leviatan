<div class="regions view">
<h2><?php  echo __('Região');?></h2>
	<dl>
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
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar região'), array('action' => 'edit', $region['Region']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Deletar região'), array('action' => 'delete', $region['Region']['id']), null, __('Deseja realmente deletar #%s?', $region['Region']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Lista de regiões'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova região'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Lista de cidades'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova cidade'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Lista de áreas'), array('controller' => 'areas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova área'), array('controller' => 'areas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Lista de unidades'), array('controller' => 'unities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova unidade'), array('controller' => 'unities', 'action' => 'add')); ?> </li>
	</ul>
</div>
