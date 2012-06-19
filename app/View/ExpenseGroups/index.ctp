<div class="expenseGroups index">
	<h2><?php echo __('Grupos de gastos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id', 'ID');?></th>
			<th><?php echo $this->Paginator->sort('name', 'Nome');?></th>
			<th><?php echo $this->Paginator->sort('description', 'Descrição');?></th>
			<th><?php echo $this->Paginator->sort('created', 'Criado');?></th>
			<th><?php echo $this->Paginator->sort('modified', 'Modificado');?></th>
			<th class="actions"><?php echo __('Ações');?></th>
	</tr>
	<?php
	foreach ($expenseGroups as $expenseGroup): ?>
	<tr>
		<td><?php echo h($expenseGroup['ExpenseGroup']['id']); ?>&nbsp;</td>
		<td><?php echo h($expenseGroup['ExpenseGroup']['name']); ?>&nbsp;</td>
		<td><?php echo h($expenseGroup['ExpenseGroup']['description']); ?>&nbsp;</td>
		<td><?php echo h($expenseGroup['ExpenseGroup']['created']); ?>&nbsp;</td>
		<td><?php echo h($expenseGroup['ExpenseGroup']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Visualizar'), array('action' => 'view', $expenseGroup['ExpenseGroup']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $expenseGroup['ExpenseGroup']['id'])); ?>
			<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $expenseGroup['ExpenseGroup']['id']), null, __('Deseja realmente deletar o grupo de gastos #%s?', $expenseGroup['ExpenseGroup']['name'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('anterior'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('próximo') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Novo grupo de gastos'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Listars PNGCs'), array('controller' => 'pngc_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo PNGC'), array('controller' => 'pngc_codes', 'action' => 'add')); ?> </li>
	</ul>
</div>
