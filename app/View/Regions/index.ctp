<div class="span2">	
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Nova região'), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('Áreas'), array('controller' => 'areas', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Cidades'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		</ul>
	</div>
</div>

<div class="span10">
	<h2><?php echo __('Regiões');?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('id', 'ID');?></th>
			<th><?php echo $this->Paginator->sort('city_id', 'Cidade');?></th>
			<th><?php echo $this->Paginator->sort('area_id', 'Área');?></th>
			<th><?php echo $this->Paginator->sort('created', 'Criado');?></th>
			<th><?php echo $this->Paginator->sort('modified', 'Modificado');?></th>
			<th><?php echo __('Ações');?></th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach ($regions as $region): ?>
	<tr>
		<td><?php echo h($region['Region']['id']); ?></td>
		<td>
			<?php echo $this->Html->link($region['City']['name'], array('controller' => 'cities', 'action' => 'view', $region['City']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($region['Area']['name'], array('controller' => 'areas', 'action' => 'view', $region['Area']['id'])); ?>
		</td>
		<td><?php echo h($region['Region']['created']); ?></td>
		<td><?php echo h($region['Region']['modified']); ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('Visualizar'), array('action' => 'view', $region['Region']['id']), array('class'=>'btn btn-primary')); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $region['Region']['id']), array('class'=>'btn btn-primary')); ?>
			<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $region['Region']['id']), array('class'=>'btn btn-danger'), __('Deseja realmente deletar # %s?', $region['Region']['id'])); ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</tbody>
	</table>

	<div class="pagination">
	<?php
		echo $this->Paginator->prev('< ' . __('anterior'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('próximo') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
