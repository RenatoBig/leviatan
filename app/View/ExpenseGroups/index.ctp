<div class="span9 well">
	<h2><?php echo __('Grupos de gastos');?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('name', 'Nome');?></th>
				<th><?php echo __('Ações');?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach ($expenseGroups as $expenseGroup): ?>
		<tr>
			<td><?php echo $this->Html->link($expenseGroup['ExpenseGroup']['name'],
					array('controller'=>'expense_groups', 'action'=>'view', $expenseGroup['ExpenseGroup']['id'])
				); ?>&nbsp;</td>
			<td>
				<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $expenseGroup['ExpenseGroup']['id']), array('class'=>'btn', 'title'=>__('Editar grupo de gastos'))); ?>
				<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $expenseGroup['ExpenseGroup']['id']), array('class'=>'btn btn-danger', 'title'=>__('Deletar grupo de gastos')), __('Deseja realmente deletar o grupo de gastos #%s?', $expenseGroup['ExpenseGroup']['name'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	
	<?php echo $this->element('pagination')?>
</div>
