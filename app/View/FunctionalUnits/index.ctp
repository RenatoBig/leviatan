<div class="span9 well">
	<h2><?php echo __('Unidades funcionais');?></h2>
	
	<?php 
	if(empty($functionalUnits)) {
		echo '<div class="alert alert-info">';
			echo '<h3>Não há unidades funcionais</h3>';
		echo '</div>';
	}else {
	?>
		<table cellpadding="0" cellspacing="0" class="table">
			<thead>
				<tr>
					<th><?php echo $this->Paginator->sort('keycode', 'Código');?></th>
					<th><?php echo $this->Paginator->sort('name', 'Nome');?></th>
					<th><?php echo __('Ações');?></th>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach($functionalUnits as $functionalUnit): ?>
			<tr>
				<td><?php echo $functionalUnit['FunctionalUnit']['keycode']?>&nbsp;</td>
				<td>
				<?php echo $this->Html->link($functionalUnit['FunctionalUnit']['name'],
						array('controller'=>'functional_units', 'action'=>'view', $functionalUnit['FunctionalUnit']['id'])
				); 
				?>
				&nbsp;
				</td>
				<td>
					<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $functionalUnit['FunctionalUnit']['id']), array('class'=>'btn', 'title'=>__('Alterar unidade funcional'))); ?>
					<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $functionalUnit['FunctionalUnit']['id']), array('class'=>'btn btn-danger', 'title'=>__('Deletar unidade funcional')), __('Deseja realmente deletar a unidade funcional #%s?', $functionalUnit['FunctionalUnit']['name'])); ?>
				</td>
			</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		
		<?php echo $this->element('pagination');?>
	<?php }?>
</div>
