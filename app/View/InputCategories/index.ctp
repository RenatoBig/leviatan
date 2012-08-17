<div class="span9 well">
	<h2><?php echo __('Categorias de insumos');?></h2>
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
		foreach ($inputCategories as $inputCategory): ?>
		<tr>
			<td><?php echo h($inputCategory['InputCategory']['name']); ?>&nbsp;</td>
			<td><?php echo h($inputCategory['InputCategory']['description']); ?>&nbsp;</td>
			<td>
				<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $inputCategory['InputCategory']['id']), array('class'=>'btn', 'title'=>'Editar categoria')); ?>
				<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $inputCategory['InputCategory']['id']), array('class'=>'btn btn-danger', 'title'=>'Deletar categoria'), __('Deseja realmente deletar a categoria #%s?', $inputCategory['InputCategory']['name'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	
	<?php echo $this->element('pagination');?>
</div>
