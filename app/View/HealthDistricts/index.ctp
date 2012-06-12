<div class="healthDistricts index">
	<h2><?php echo __('Distritos sanitários');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id', 'ID');?></th>
			<th><?php echo $this->Paginator->sort('name', 'Nome');?></th>
			<th><?php echo $this->Paginator->sort('created', 'Criado');?></th>
			<th><?php echo $this->Paginator->sort('modified', 'Modificado');?></th>
			<th class="actions"><?php echo __('Ações');?></th>
	</tr>
	<?php
	foreach ($healthDistricts as $healthDistrict): ?>
	<tr>
		<td><?php echo h($healthDistrict['HealthDistrict']['id']); ?>&nbsp;</td>
		<td><?php echo h($healthDistrict['HealthDistrict']['name']); ?>&nbsp;</td>
		<td><?php echo h($healthDistrict['HealthDistrict']['created']); ?>&nbsp;</td>
		<td><?php echo h($healthDistrict['HealthDistrict']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Visualizar'), array('action' => 'view', $healthDistrict['HealthDistrict']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $healthDistrict['HealthDistrict']['id'])); ?>
			<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $healthDistrict['HealthDistrict']['id']), null, __('Deseja realmente deletar o distrito sanitário #%s?', $healthDistrict['HealthDistrict']['name'])); ?>
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
		<li><?php echo $this->Html->link(__('Novo distrito sanitário'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Lista de unidades'), array('controller' => 'unities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova unidade'), array('controller' => 'unities', 'action' => 'add')); ?> </li>
	</ul>
</div>
