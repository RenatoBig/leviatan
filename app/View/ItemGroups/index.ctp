<div class="span9 well">
	<h2><?php echo __('Itens dos grupos');?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
		<thead>
			<tr>		
				<th><?php echo $this->Paginator->sort('keycode', 'Código');?></th>
				<th><?php echo $this->Paginator->sort('name', 'Nome');?></th>
				<th><?php echo $this->Paginator->sort('group_type_id', 'Tipo do grupo');?></th>
				<th><?php echo __('Ações');?></th>		
			</tr>
		</thead>
		<tbody>
		<?php
		foreach ($itemGroups as $itemGroup): ?>
		<tr>
			<td><?php echo h($itemGroup['ItemGroup']['keycode']); ?>&nbsp;</td>
			<td><?php echo h($itemGroup['ItemGroup']['name']); ?>&nbsp;</td>
			<td><?php echo $this->Html->link($itemGroup['GroupType']['name'], array('controller' => 'group_types', 'action' => 'view', $itemGroup['GroupType']['id'])); ?></td>
			<td>
				<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $itemGroup['ItemGroup']['id']), array('class'=>'btn', 'title'=>__('Alterar o item do grupo'))); ?>
				<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $itemGroup['ItemGroup']['id']), array('class'=>'btn btn-danger', 'title'=>__('Excluir o item do grupo')), __('Deseja realmente deletar o item do grupo #%s?', $itemGroup['ItemGroup']['name'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	
	<?php echo $this->element('pagination')?>
</div>
