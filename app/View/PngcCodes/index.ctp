<div class="span9 well">
	<h2><?php echo __('PNGCs');?></h2>
	<?php 
	if(empty($pngcCodes)) {
		echo '<div class="alert alert-info">';
			echo '<h3>Não há códigos pngc</h3>';
		echo '</div>';
	}else {
	?>
		<table cellpadding="0" cellspacing="0" class="table">
			<thead>
				<tr>
					<th><?php echo $this->Paginator->sort('keycode', 'Código');?></th>
					<th><?php echo $this->Paginator->sort('expense_group_id', 'Grupo de gastos');?></th>
					<th><?php echo 'Categoria'?></th>
					<th><?php echo 'Subcategoria'?></th>
					<th><?php echo $this->Paginator->sort('measure_type_id', 'Tipo de medida');?></th>
					<th><?php echo __('Ações');?></th>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach ($pngcCodes as $pngcCode): ?>
			<tr>
				<td><?php echo $pngcCode['PngcCode']['keycode']; ?></td>
				<td>
					<?php echo $this->Html->link($pngcCode['ExpenseGroup']['name'], array('controller' => 'expense_groups', 'action' => 'view', $pngcCode['ExpenseGroup']['id'])); ?>
				</td>
				<td>
					<?php echo $this->Html->link($pngcCode['InputCategory']['name'], array('controller' => 'input_categories', 'action' => 'view', $pngcCode['InputCategory']['id'])); ?>
				</td>
				<td>
					<?php 
					if($pngcCode['InputSubcategory'] != null){
						echo $this->Html->link($pngcCode['InputSubcategory']['name'], array('controller' => 'input_subcategories', 'action' => 'view', $pngcCode['InputSubcategory']['id']));
					}else {
						echo '--';
					}
					?>
				</td>
				<td>
					<?php echo $this->Html->link($pngcCode['MeasureType']['name'], array('controller' => 'measure_types', 'action' => 'view', $pngcCode['MeasureType']['id'])); ?>
				</td>
				<td>
					<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $pngcCode['PngcCode']['id']), array('class'=>'btn')); ?>
					<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $pngcCode['PngcCode']['id']), array('class'=>'btn btn-danger'), __('Deseja realmente deletar o PNGC #%s?', $pngcCode['PngcCode']['keycode'])); ?>
				</td>
			</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		<?php echo $this->element('pagination');?>
	<?php }?>
</div>
