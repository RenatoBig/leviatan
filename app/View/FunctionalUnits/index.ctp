<div class="span9 well">
	<h2><?php echo __('Unidades funcionais');?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('name', 'Nome');?></th>
				<th><?php echo $this->Paginator->sort('description', 'Descrição');?></th>
				<th><?php echo __('Ações');?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach ($functionalUnits as $functionalUnit): ?>
		<tr>
			<td><?php echo h($functionalUnit['FunctionalUnit']['name']); ?>&nbsp;</td>
			<td><?php echo h($functionalUnit['FunctionalUnit']['description']); ?>&nbsp;</td>
			<td>
				<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $functionalUnit['FunctionalUnit']['id']), array('class'=>'btn', 'title'=>__('Alterar unidade funcional'))); ?>
				<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $functionalUnit['FunctionalUnit']['id']), array('class'=>'btn btn-danger', 'title'=>__('Deletar unidade funcional')), __('Deseja realmente deletar a unidade funcional #%s?', $functionalUnit['FunctionalUnit']['name'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	
	<?php echo $this->element('pagination');?>
</div>
