<div class="span9 well">
	<h2><?php echo __('Tipos dos grupos');?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('name', "Nome");?></th>
				<th><?php echo __('Ações');?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach ($groupTypes as $groupType): ?>
		<tr>
			<td><?php echo h($groupType['GroupType']['name']); ?>&nbsp;</td>
			<td>
				<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $groupType['GroupType']['id']), array('class'=>'btn', 'title'=>__('Alterar tipo do grupo'))); ?>
				<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $groupType['GroupType']['id']), array('class'=>'btn btn-danger', 'title'=>__('Deletar tipo do grupo')), __('Deseja realmente deletar o tipo do grupo #%s?', $groupType['GroupType']['name'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	
	<?php echo $this->element('pagination')?>
</div>
