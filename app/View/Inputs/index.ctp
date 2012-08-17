<div class="span9 well">
	<h2><?php echo __('Insumos');?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('input_category_id', 'Categoria');?></th>
				<th><?php echo $this->Paginator->sort('input_subcategory_id', 'Subcategoria');?></th>
				<th><?php echo __('Ações');?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach ($inputs as $input): ?>
		<tr>
			<td>
				<?php echo $this->Html->link($input['InputCategory']['name'], array('controller' => 'input_categories', 'action' => 'view', $input['InputCategory']['id'])); ?>
			</td>
			<td>
				<?php echo $this->Html->link($input['InputSubcategory']['name'], array('controller' => 'input_subcategories', 'action' => 'view', $input['InputSubcategory']['id'])); ?>
			</td>
			<td>
				<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $input['Input']['id']), array('class'=>'btn', 'title'=>__('Alterar insumo'))); ?>
				<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $input['Input']['id']), array('class'=>'btn btn-danger', 'title'=>__('Deletar insumo')), __('Deseja realmente deletar o insumo # %s?', $input['Input']['id'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	
	<?php echo $this->element('pagination');?>
</div>
