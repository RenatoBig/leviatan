<div class="itemGroups view">
<h2><?php  echo __('Item do grupo');?></h2>
	<dl>
		<dt><?php echo __('Id', 'ID'); ?></dt>
		<dd>
			<?php echo h($itemGroup['ItemGroup']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Keycode', 'Código'); ?></dt>
		<dd>
			<?php echo h($itemGroup['ItemGroup']['keycode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($itemGroup['ItemGroup']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tipo do grupo'); ?></dt>
		<dd>
			<?php echo $this->Html->link($itemGroup['GroupType']['name'], array('controller' => 'group_types', 'action' => 'view', $itemGroup['GroupType']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Criado'); ?></dt>
		<dd>
			<?php echo h($itemGroup['ItemGroup']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($itemGroup['ItemGroup']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar item do grupo'), array('action' => 'edit', $itemGroup['ItemGroup']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Deletar item do grupo'), array('action' => 'delete', $itemGroup['ItemGroup']['id']), null, __('Deseja relmente deletar o item do grupo #%s?', $itemGroup['ItemGroup']['name'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listar itens dos grupos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo item do grupo'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar tipos dos grupos'), array('controller' => 'group_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo tipo do grupo'), array('controller' => 'group_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
