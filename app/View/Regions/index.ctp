<div class="regions index">
	<h2><?php echo __('Regiões');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id', 'ID');?></th>
			<th><?php echo $this->Paginator->sort('city_id', 'Cidade');?></th>
			<th><?php echo $this->Paginator->sort('area_id', 'Área');?></th>
			<th><?php echo $this->Paginator->sort('created', 'Criado');?></th>
			<th><?php echo $this->Paginator->sort('modified', 'Modificado');?></th>
			<th class="actions"><?php echo __('Ações');?></th>
	</tr>
	<?php
	foreach ($regions as $region): ?>
	<tr>
		<td><?php echo h($region['Region']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($region['City']['name'], array('controller' => 'cities', 'action' => 'view', $region['City']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($region['Area']['name'], array('controller' => 'areas', 'action' => 'view', $region['Area']['id'])); ?>
		</td>
		<td><?php echo h($region['Region']['created']); ?>&nbsp;</td>
		<td><?php echo h($region['Region']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Visualizar'), array('action' => 'view', $region['Region']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $region['Region']['id'])); ?>
			<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $region['Region']['id']), null, __('Deseja realmente deletar # %s?', $region['Region']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('Nova região'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Lista de cidades'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova cidade'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Lista de áreas'), array('controller' => 'areas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova área'), array('controller' => 'areas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Lista de unidades'), array('controller' => 'unities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova unidade'), array('controller' => 'unities', 'action' => 'add')); ?> </li>
	</ul>
</div>
