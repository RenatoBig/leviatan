<div class="expenseGroups view">
<h2><?php  echo __('Grupo de gastos');?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($expenseGroup['ExpenseGroup']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($expenseGroup['ExpenseGroup']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Descrição'); ?></dt>
		<dd>
			<?php echo h($expenseGroup['ExpenseGroup']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Criado'); ?></dt>
		<dd>
			<?php echo h($expenseGroup['ExpenseGroup']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($expenseGroup['ExpenseGroup']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar grupo de gastos'), array('action' => 'edit', $expenseGroup['ExpenseGroup']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Deletar grupo de gastos'), array('action' => 'delete', $expenseGroup['ExpenseGroup']['id']), null, __('Deseja realmente deletar o grupo de gastos #%s?', $expenseGroup['ExpenseGroup']['name'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listar grupo de gastos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo grupo de gastos'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar PNGCs'), array('controller' => 'pngc_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo PNGC'), array('controller' => 'pngc_codes', 'action' => 'add')); ?> </li>
	</ul>
</div>
