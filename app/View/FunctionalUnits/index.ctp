<div class="functionalUnits index">
	<h2><?php echo __('Unidades funcionais');?></h2>
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
	foreach ($functionalUnits as $functionalUnit): ?>
	<tr>
		<td><?php echo h($functionalUnit['FunctionalUnit']['id']); ?>&nbsp;</td>
		<td><?php echo h($functionalUnit['FunctionalUnit']['name']); ?>&nbsp;</td>
		<td><?php echo h($functionalUnit['FunctionalUnit']['description']); ?>&nbsp;</td>
		<td><?php echo h($functionalUnit['FunctionalUnit']['created']); ?>&nbsp;</td>
		<td><?php echo h($functionalUnit['FunctionalUnit']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Visualizar'), array('action' => 'view', $functionalUnit['FunctionalUnit']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $functionalUnit['FunctionalUnit']['id'])); ?>
			<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $functionalUnit['FunctionalUnit']['id']), null, __('Deseja realmente deletar a unidade funcional #%s?', $functionalUnit['FunctionalUnit']['name'])); ?>
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
		<li><?php echo $this->Html->link(__('Nova unidade funcional'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Listar PNGC'), array('controller' => 'pngc_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo PNGC'), array('controller' => 'pngc_codes', 'action' => 'add')); ?> </li>
	</ul>
</div>
