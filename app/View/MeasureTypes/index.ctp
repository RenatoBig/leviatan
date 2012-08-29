<div class="span9 well">
	<h2><?php echo __('Tipos de medidas');?></h2>
	<?php 
	if(empty($measureTypes)) {
		echo '<div class="alert alert-info">';
			echo '<h3>Não há tipos de medidas</h3>';
		echo '</div>';		
	}else {?>	
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
			foreach ($measureTypes as $measureType): ?>
			<tr>
				<td><?php echo $this->Html->link($measureType['MeasureType']['name'], array('controller'=>'measure_types', 'action'=>'view', $measureType['MeasureType']['id'])); ?>&nbsp;</td>
				<td><?php echo h($measureType['MeasureType']['description']); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $measureType['MeasureType']['id']), array('class'=>'btn', 'title'=>__('Alterar tipo de medida'))); ?>
					<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $measureType['MeasureType']['id']), array('class'=>'btn btn-danger', 'title'=>__('Deletar tipo de medida')), __('Deseja realmente deletar o tipo de medida #%s?', $measureType['MeasureType']['name'])); ?>
				</td>
			</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		<?php echo $this->element('pagination');?>
	<?php }?>
</div>
