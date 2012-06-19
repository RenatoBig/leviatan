<div class="groupTypes view">
<h2><?php  echo __('Tipo do grupo');?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($groupType['GroupType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($groupType['GroupType']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Criado'); ?></dt>
		<dd>
			<?php echo h($groupType['GroupType']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($groupType['GroupType']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar tipo do grupo'), array('action' => 'edit', $groupType['GroupType']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Deletar tipo do grupo'), array('action' => 'delete', $groupType['GroupType']['id']), null, __('Deseja realmente deletar o tipo do grupo #%s?', $groupType['GroupType']['name'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listar tipos dos grupos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo tipo do grupo'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar itens de grupos'), array('controller' => 'item_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo item do grupo'), array('controller' => 'item_groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
