<?php 
if(empty($unitySectors)) {
	echo "<div class='alert alert-info'>";
	echo "<h3>Não há tipos de unidades</h3>";
	echo "</div>";	
} else{?>
<div class="span9 well">
	<h2><?php echo __('Unidades_setores');?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('unity_id', 'Unidade');?></th>
			<th><?php echo $this->Paginator->sort('sector_id', 'Setor');?></th>
			<th><?php echo __('Ações');?></th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach ($unitySectors as $unitySector): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($unitySector['Unity']['name'], array('controller' => 'unities', 'action' => 'view', $unitySector['Unity']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($unitySector['Sector']['name'], array('controller' => 'sectors', 'action' => 'view', $unitySector['Sector']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $unitySector['UnitySector']['id']), array('class'=>'btn', 'title'=>__('Editar unidade_setor'))); ?>
			<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $unitySector['UnitySector']['id']), array('class'=>'btn btn-danger', 'title'=>__('Deletar unidade_setor')), __('Deseja realmente deletar a unidade_setor # %s?', $unitySector['UnitySector']['id'])); ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</tbody>
	</table>

	<?php echo $this->element('pagination'); ?>	
	
</div>
<?php 
}
?>