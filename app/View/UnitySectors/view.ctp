<div class="unitySectors view">
<h2><?php  echo __('Unidade_setor');?></h2>
	<dl>
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
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar unidade_setor'), array('action' => 'edit', $unitySector['UnitySector']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Deletar unidade_setor'), array('action' => 'delete', $unitySector['UnitySector']['id']), null, __('Deseja realmente deletar a unidade_setor # %s?', $unitySector['UnitySector']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listar unidades_setores'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova unidade_setor'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar unidades'), array('controller' => 'unities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova unidade'), array('controller' => 'unities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar setores'), array('controller' => 'sectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo setor'), array('controller' => 'sectors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar funcionários'), array('controller' => 'employees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo funcionário'), array('controller' => 'employees', 'action' => 'add')); ?> </li>
	</ul>
</div>
