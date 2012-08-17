<?php 
if(empty($users)) {
	echo "<div class='alert alert-info'>";
	echo "<h3>Não há usuários</h3>";
	echo "</div>";	
} else{?>
<div class="span9 well">
	<h2><?php echo __('Usuários');?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('employee_id', 'Funcionário');?></th>
			<th><?php echo $this->Paginator->sort('username', 'Usuário');?></th>
			<th><?php echo $this->Paginator->sort('group_id', 'Grupo');?></th>
			<th><?php echo __('Ações');?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($users as $user):?>
		<tr>
			<td><?php echo $this->Html->link($user['Employee']['name'], array('controller'=>'employees', 'action'=>'view', $user['Employee']['id']), array('title'=>'Visualizar dados do funcionário'));?>&nbsp;</td>
			<td><?php echo $this->Html->link($user['User']['username'], array('controller'=>'users', 'action'=>'view', $user['User']['id']), array('title'=>'Visualizar dados do usuário'));?>&nbsp;</td>
			<td><?php echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id']), array('title'=>'Visualizar dados do grupo')); ?></td>
			<td>
				<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $user['User']['id']), array('class'=>'btn', 'title'=>__('Editar usuário'))); ?>
				<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $user['User']['id']), array('class'=>'btn btn-danger', 'title'=>__('Deletar usuário')), __('Deseja realmente deletar o usuário #%s?', $user['User']['username'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
	</table>

	<?php echo $this->element('pagination'); ?> 
</div>
<?php 
}
?>

