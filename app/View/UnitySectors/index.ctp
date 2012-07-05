<div class="span2">
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Adicionar unidade_setor'), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('Unidades'), array('controller'=>'unities', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('Funcionários'), array('controller'=>'employees', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('Setores'), array('controller'=>'sectors', 'action' => 'index')); ?></li>
		</ul>
	</div>
</div>

<?php 
if(empty($unitySectors)) {
	echo "<div class='span4 alert alert-info'>";
	echo "<h3>Não há tipos de unidades</h3>";
	echo "</div>";	
} else{?>
<div class="span8">
	<h2><?php echo __('Unidades_setores');?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('unity_id', 'Unidade');?></th>
			<th><?php echo $this->Paginator->sort('sector_id', 'Setor');?></th>
			<th class="actions"><?php echo __('Ações');?></th>
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
		<td class="actions">
			<?php echo $this->Html->link(__('Visualizar'), array('action' => 'view', $unitySector['UnitySector']['id']), array('class'=>'btn btn-primary')); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $unitySector['UnitySector']['id']), array('class'=>'btn btn-primary')); ?>
			<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $unitySector['UnitySector']['id']), array('class'=>'btn btn-danger'), __('Deseja realmente deletar a unidade_setor # %s?', $unitySector['UnitySector']['id'])); ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</tbody>
	</table>

	<div class="pagination">
	<?php
		echo $this->Paginator->prev('< ' . __('anterior'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('próximo') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<?php 
}
?>