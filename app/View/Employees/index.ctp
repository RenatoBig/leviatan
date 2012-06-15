<div class="employees index">
	<h2><?php echo __('Funcionários');?></h2>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo $this->Paginator->sort('id', 'ID');?></th>
			<th><?php echo $this->Paginator->sort('registration', 'Matrícula');?></th>
			<th><?php echo $this->Paginator->sort('name', 'Nome');?></th>
			<th><?php echo $this->Paginator->sort('birth_date', 'Aniversário');?></th>
			<th><?php echo $this->Paginator->sort('email', 'Email');?></th>
			<th><?php echo $this->Paginator->sort('phone', 'Telefone');?></th>
			<th><?php echo $this->Paginator->sort('rg', 'RG');?></th>
			<th><?php echo $this->Paginator->sort('cpf', 'CPF');?></th>
			<th><?php echo $this->Paginator->sort('voter_card', 'Título eleitoral');?></th>
			<th><?php echo $this->Paginator->sort('ctps', 'CTPS');?></th>
			<th><?php echo $this->Paginator->sort('reservist', 'Reservista');?></th>
			<th><?php echo $this->Paginator->sort('agency', 'Agência');?></th>
			<th><?php echo $this->Paginator->sort('account', 'Conta');?></th>
			<th><?php echo $this->Paginator->sort('unity_sector_id', 'Unidade_Setor');?></th>
			<th><?php echo $this->Paginator->sort('created', 'Criado');?></th>
			<th><?php echo $this->Paginator->sort('modified', 'Modificado');?></th>
			<th class="actions"><?php echo __('Ações');?></th>
		</tr>
	<?php
		foreach ($employees as $employee): ?>
		<tr>
			<td><?php echo h($employee['Employee']['id']); ?>&nbsp;</td>
			<td><?php echo h($employee['Employee']['registration']); ?>&nbsp;</td>
			<td><?php echo h($employee['Employee']['name']); ?>&nbsp;</td>
			<td><?php echo h($employee['Employee']['birth_date']); ?>&nbsp;</td>
			<td><?php echo h($employee['Employee']['email']); ?>&nbsp;</td>
			<td><?php echo h($employee['Employee']['phone']); ?>&nbsp;</td>
			<td><?php echo h($employee['Employee']['rg']); ?>&nbsp;</td>
			<td><?php echo h($employee['Employee']['cpf']); ?>&nbsp;</td>
			<td><?php echo h($employee['Employee']['voter_card']); ?>&nbsp;</td>
			<td><?php echo h($employee['Employee']['ctps']); ?>&nbsp;</td>
			<td><?php echo h($employee['Employee']['reservist']); ?>&nbsp;</td>
			<td><?php echo h($employee['Employee']['agency']); ?>&nbsp;</td>
			<td><?php echo h($employee['Employee']['account']); ?>&nbsp;</td>
			<td>
				<?php echo $this->Html->link($employee['UnitySector']['id'], array('controller' => 'unity_sectors', 'action' => 'view', $employee['UnitySector']['id'])); ?>
			</td>
			<td><?php echo h($employee['Employee']['created']); ?>&nbsp;</td>
			<td><?php echo h($employee['Employee']['modified']); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('Visualizar'), array('action' => 'view', $employee['Employee']['id'])); ?>
				<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $employee['Employee']['id'])); ?>
				<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $employee['Employee']['id']), null, __('Deseja realmente deletar o funcionário #%s?', $employee['Employee']['name'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	
	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('anterior'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('próximo') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Novo funcionário'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Listar unidades_setores'), array('controller' => 'unity_sectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo unidade_setor'), array('controller' => 'unity_sectors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar usuários'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novos usuários'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
