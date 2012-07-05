<div class="span2">	
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Novo grupo'), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('Usuários'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		</ul>
	</div>
</div>

<div class="span6">
	<h2><?php echo __('Grupos');?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('ID', 'id');?></th>
				<th><?php echo $this->Paginator->sort('name', 'Nome');?></th>
				<th class="actions"><?php echo __('Ações');?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach ($groups as $group): ?>		
			<tr>
				<td><?php echo h($group['Group']['id']); ?></td>
				<td><?php echo h($group['Group']['name']); ?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('Visualizar'), array('action' => 'view', $group['Group']['id']), array('class'=>'btn btn-primary')); ?>
					<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $group['Group']['id']), array('class'=>'btn btn-primary')); ?>
					<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $group['Group']['id']), array('class'=>'btn btn-danger'), __('Deseja relamente deletar o grupo #%s?', $group['Group']['name'])); ?>
				</td>
			</tr>		
		<?php endforeach; ?>
		</tbody>
	</table>	

	<div class="pagination">
	<?php
		echo $this->Paginator->prev('< ' . __('anterior'), array(), null, array('class' => 'disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('próximo') . ' >', array(), null, array('class' => 'disabled'));
	?>
	</div>
</div>

