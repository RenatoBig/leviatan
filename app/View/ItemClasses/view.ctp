<div class="itemClasses view">
<h2><?php  echo __('Item Class');?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($itemClass['ItemClass']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Grupo do item'); ?></dt>
		<dd>
			<?php echo $this->Html->link($itemClass['ItemGroup']['name'], array('controller' => 'item_groups', 'action' => 'view', $itemClass['ItemGroup']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Código'); ?></dt>
		<dd>
			<?php echo h($itemClass['ItemClass']['keycode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($itemClass['ItemClass']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Criado'); ?></dt>
		<dd>
			<?php echo h($itemClass['ItemClass']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($itemClass['ItemClass']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar Classe do item'), array('action' => 'edit', $itemClass['ItemClass']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Deletar classe do item'), array('action' => 'delete', $itemClass['ItemClass']['id']), null, __('Deseja realmente deletar a classe do item #%s?', $itemClass['ItemClass']['name'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listar classes dos itens'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova classe do item'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar grupos dos itens'), array('controller' => 'item_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo grupo do item'), array('controller' => 'item_groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar itens'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
