<div class="statuses index">
	<h2><?php echo __('Status');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id', 'ID');?></th>
			<th><?php echo $this->Paginator->sort('name', 'Nome');?></th>
			<th><?php echo $this->Paginator->sort('created', 'Criado');?></th>
			<th><?php echo $this->Paginator->sort('modified', 'Modificado');?></th>
			<th class="actions"><?php echo __('Ações');?></th>
	</tr>
	<?php
	foreach ($statuses as $status): ?>
	<tr>
		<td><?php echo h($status['Status']['id']); ?>&nbsp;</td>
		<td><?php echo h($status['Status']['name']); ?>&nbsp;</td>
		<td><?php echo h($status['Status']['created']); ?>&nbsp;</td>
		<td><?php echo h($status['Status']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Visualizar'), array('action' => 'view', $status['Status']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $status['Status']['id'])); ?>
			<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $status['Status']['id']), null, __('Deseja realmente deletar o status #%s?', $status['Status']['name'])); ?>
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
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Novo status'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Order Items'), array('controller' => 'order_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Item'), array('controller' => 'order_items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
	</ul>
</div>
