<div class="measureTypes index">
	<h2><?php echo __('tipod de medidas');?></h2>
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
	foreach ($measureTypes as $measureType): ?>
	<tr>
		<td><?php echo h($measureType['MeasureType']['id']); ?>&nbsp;</td>
		<td><?php echo h($measureType['MeasureType']['name']); ?>&nbsp;</td>
		<td><?php echo h($measureType['MeasureType']['description']); ?>&nbsp;</td>
		<td><?php echo h($measureType['MeasureType']['created']); ?>&nbsp;</td>
		<td><?php echo h($measureType['MeasureType']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Visualizar'), array('action' => 'view', $measureType['MeasureType']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $measureType['MeasureType']['id'])); ?>
			<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $measureType['MeasureType']['id']), null, __('Deseja realmente deletar o tipo de medida #%s?', $measureType['MeasureType']['name'])); ?>
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
	<h3><?php echo __('Açõed'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Novo tipo de medida'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Listar PNGCs'), array('controller' => 'pngc_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo PNGC'), array('controller' => 'pngc_codes', 'action' => 'add')); ?> </li>
	</ul>
</div>
