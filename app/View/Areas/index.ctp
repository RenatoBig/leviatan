<div class="span9 well">
	<h2><?php echo __('Áreas');?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('name', 'Nome');?></th>
				<th><?php echo __('Ações');?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach ($areas as $area): ?>
		<tr>
			<td><?php echo h($area['Area']['name']); ?>&nbsp;</td>
			<td>
				<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $area['Area']['id']), array('class'=>'btn', 'title'=>__('Alterar área'))); ?>
				<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $area['Area']['id']), array('class'=>'btn btn-danger', 'title'=>__('Deletar área')), __('deseja realmente deletar #%s?', $area['Area']['name'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	
	<?php echo $this->element('pagination')?>
</div>
