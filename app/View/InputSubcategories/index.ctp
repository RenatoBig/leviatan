<div class="span9 well">
	<h2><?php echo __('Subcategorias de insumos');?></h2>
	<?php 
	if(empty($inputSubcategories)) {
		echo '<div class="alert alert-info">';
			echo '<h3>Não há subcategorias</h3>';
		echo '</div>';
	}else {
	?>
		<table cellpadding="0" cellspacing="0" class="table">
			<thead>
				<tr>
					<th><?php echo $this->Paginator->sort('name', 'Nome');?></th>
					<th><?php echo __('Ações');?></th>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach ($inputSubcategories as $inputSubcategory): ?>
			<tr>
				<td><?php echo $this->Html->link($inputSubcategory['InputSubcategory']['name'], array('controller'=>'input_subcategories', 'action'=>'view', $inputSubcategory['InputSubcategory']['id'])); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $inputSubcategory['InputSubcategory']['id']), array('class'=>'btn', 'title'=>'Editar subcategoria')); ?>
					<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $inputSubcategory['InputSubcategory']['id']), array('class'=>'btn btn-danger', 'title'=>'Deletar subcategoria'), __('Deseja realmente deletar a subcategoria #%s?', $inputSubcategory['InputSubcategory']['name'])); ?>
				</td>
			</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		
		<?php echo $this->element('pagination');?>
	<?php }?>
</div>
