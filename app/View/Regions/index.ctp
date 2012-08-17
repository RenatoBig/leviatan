<div class="span9 well">
	<h2><?php echo __('Regiões');?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('city_id', 'Cidade');?></th>
			<th><?php echo $this->Paginator->sort('area_id', 'Área');?></th>
			<th><?php echo __('Ações');?></th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach ($regions as $region): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($region['City']['name'], array('controller' => 'cities', 'action' => 'view', $region['City']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($region['Area']['name'], array('controller' => 'areas', 'action' => 'view', $region['Area']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $region['Region']['id']), array('class'=>'btn', 'title'=>__('Alterar região'))); ?>
			<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $region['Region']['id']), array('class'=>'btn btn-danger', 'title'=>__('Deletar região')), __('Deseja realmente deletar # %s?', $region['Region']['id'])); ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</tbody>
	</table>

	<?php echo $this->element('pagination');?>
</div>
