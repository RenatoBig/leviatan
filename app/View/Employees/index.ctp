<div class="span9 well">
	<?php 
	if(empty($employees)) {
		echo "<div class='alert alert-info'>";
		echo "<h3>Não há funcionários</h3>";
		echo "</div>";	
	} else{?>
	
	<h2><?php echo __('Funcionários');?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('registration', 'Matrícula');?></th>
				<th><?php echo $this->Paginator->sort('name', 'Nome');?></th>
				<th><?php echo $this->Paginator->sort('email', 'Email');?></th>
				<th><?php echo $this->Paginator->sort('phone', 'Telefone');?></th>
				<th><?php echo $this->Paginator->sort('unity_sector_id', 'Unidade_Setor');?></th>
				<th><?php echo __('Ações');?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach ($employees as $employee): ?>
		<tr>
			<td><?php echo h($employee['Employee']['registration']); ?>&nbsp;</td>
			<td><?php echo $this->Html->link($employee['Employee']['name'], array('controller'=>'employees', 'action'=>'view', $employee['Employee']['id']), array('title'=>'Visualizar dados do funcionário')); ?>&nbsp;</td>
			<td><?php echo h($employee['Employee']['email']); ?>&nbsp;</td>
			<td><?php echo h($employee['Employee']['phone']); ?>&nbsp;</td>
			<td>
				<?php echo $this->Html->link($employee['UnitySector']['id'], array('controller' => 'unity_sectors', 'action' => 'view', $employee['UnitySector']['id']), array('title'=>__('Visualizar dados da unidade e do setor'))); ?>
			</td>
			<td>
				<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $employee['Employee']['id']), array('class'=>'btn', 'title'=>__('Editar funcionário'))); ?>
				<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $employee['Employee']['id']), array('class'=>'btn btn-danger', 'title'=>__('Deletar funcionário'), __('Deseja realmente deletar o funcionário #%s?', $employee['Employee']['name']))); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	
	<?php 
		echo $this->element('pagination');
	}
	?>	
</div>
