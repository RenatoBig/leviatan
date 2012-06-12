<div class="sectors view">
<h2><?php  echo __('Setor');?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($sector['Sector']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($sector['Sector']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Criado'); ?></dt>
		<dd>
			<?php echo h($sector['Sector']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($sector['Sector']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar Setor'), array('action' => 'edit', $sector['Sector']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Deletar Setor'), array('action' => 'delete', $sector['Sector']['id']), null, __('Deseja realmente deletar o setor #%s?', $sector['Sector']['name'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Setores'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo setor'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar unidades_setores'), array('controller' => 'unity_sectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo unidade_setor'), array('controller' => 'unity_sectors', 'action' => 'add')); ?> </li>
	</ul>
</div>
