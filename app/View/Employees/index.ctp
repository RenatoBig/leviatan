<div class="span2">	
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Novo funcionário'), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('Usuários'), array('controller' => 'users', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Unidades setores'), array('controller' => 'unity_sectors', 'action' => 'index')); ?> </li>
		</ul>
	</div>
</div>

<?php 
if(empty($employees)) {
	echo "<div class='span4 alert alert-info'>";
	echo "<h3>Não há funcionários</h3>";
	echo "</div>";	
} else{?>
<div class="span8">
	<h2><?php echo __('Funcionários');?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('registration', 'Matrícula');?></th>
			<th><?php echo $this->Paginator->sort('name', 'Nome');?></th>
			<th><?php echo $this->Paginator->sort('email', 'Email');?></th>
			<th><?php echo $this->Paginator->sort('phone', 'Telefone');?></th>
			<th><?php echo $this->Paginator->sort('unity_sector_id', 'Unidade_Setor');?></th>
			<th class="actions"><?php echo __('Ações');?></th>
		</tr>
	</thead>
	<tbody>
	<?php
		foreach ($employees as $employee): ?>
		<tr>
			<td><?php echo h($employee['Employee']['registration']); ?>&nbsp;</td>
			<td><?php echo h($employee['Employee']['name']); ?>&nbsp;</td>
			<td><?php echo h($employee['Employee']['email']); ?>&nbsp;</td>
			<td><?php echo h($employee['Employee']['phone']); ?>&nbsp;</td>
			<td>
				<?php echo $this->Html->link($employee['UnitySector']['id'], array('controller' => 'unity_sectors', 'action' => 'view', $employee['UnitySector']['id'])); ?>
			</td>
			<td class="actions">
				<?php echo $this->Html->link(__('Visualizar'), array('action' => 'view', $employee['Employee']['id']), array('class'=>'btn btn-primary')); ?>
				<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $employee['Employee']['id']), array('class'=>'btn btn-primary')); ?>
				<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $employee['Employee']['id']), array('class'=>'btn btn-danger'), __('Deseja realmente deletar o funcionário #%s?', $employee['Employee']['name'])); ?>
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
<?php 
}
?>
