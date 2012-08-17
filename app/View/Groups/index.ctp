<div class="span9 well">
	<h2><?php echo __('Grupos');?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('id', 'ID');?></th>
				<th><?php echo $this->Paginator->sort('name', 'Nome');?></th>
				<th><?php echo __('Ações');?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach ($groups as $group): ?>		
			<tr>
				<td><?php echo h($group['Group']['id']); ?></td>
				<td><?php echo h($group['Group']['name']); ?></td>
				<td>
					<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $group['Group']['id']), array('class'=>'btn')); ?>
					<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $group['Group']['id']), array('class'=>'btn btn-danger'), __('Deseja relamente deletar o grupo #%s?', $group['Group']['name'])); ?>
				</td>
			</tr>		
		<?php endforeach; ?>
		</tbody>
	</table>	

	<?php echo $this->element('pagination'); ?>
</div>

