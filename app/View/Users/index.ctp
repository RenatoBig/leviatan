<div class="span2">
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Novo usuário'), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('Grupos'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Funcionários'), array('controller' => 'employees', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Pedidos'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		</ul>
	</div>
</div>

<div class="span10">
	<h2><?php echo __('Users');?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('id', 'ID');?></th>
			<th><?php echo $this->Paginator->sort('employee_id', 'Funcionário');?></th>
			<th><?php echo $this->Paginator->sort('username', 'Usuário');?></th>
			<th><?php echo $this->Paginator->sort('password', 'Senha');?></th>
			<th><?php echo $this->Paginator->sort('group_id', 'Grupo');?></th>
			<th><?php echo $this->Paginator->sort('created', 'Criado');?></th>
			<th><?php echo $this->Paginator->sort('modified', 'Modificado');?></th>
			<th class="actions"><?php echo __('Ações');?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($users as $user):?>
		<tr>
			<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
			<td><?php echo h($user['Employee']['name']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['password']); ?>&nbsp;</td>
			<td>
				<?php echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?>
			</td>
			<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['modified']); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('Visualizar'), array('action' => 'view', $user['User']['id']), array('class'=>'btn btn-primary')); ?>
				<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $user['User']['id']), array('class'=>'btn btn-primary')); ?>
				<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $user['User']['id']), array('class'=>'btn btn-danger'), __('Deseja realmente deletar o usuário #%s?', $user['User']['username'])); ?>
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

