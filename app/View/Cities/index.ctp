<div class="span9 well">
	<h2><?php echo __('Cidades');?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('keycode', 'Código');?></th>
			<th><?php echo $this->Paginator->sort('name', 'Nome');?></th>
			<th><?php echo __('Ações');?></th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach ($cities as $city): ?>
	<tr>
		<td><?php echo h($city['City']['keycode']);?></td>
		<td><?php echo h($city['City']['name']);?></td>
		<td>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $city['City']['id']), array('class'=>'btn', 'title'=>__('Alterar cidade'))); ?>
			<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $city['City']['id']), array('class'=>'btn btn-danger', 'title'=>'Deletar cidade'), __('Deseja realmente deletar # %s?', $city['City']['name'])); ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</tbody>
	</table>

	<?php echo $this->element('pagination')?>
</div>
