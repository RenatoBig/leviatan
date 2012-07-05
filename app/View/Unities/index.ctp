<div class="span2">
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Adicionar unidade'), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('Tipos das unidades'), array('controller'=>'unity_types', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('Distritos sanitários'), array('controller'=>'health_districts', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('Unidades setor'), array('controller'=>'unity_sectors', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('Regiões'), array('controller'=>'regions', 'action' => 'index')); ?></li>
		</ul>
	</div>
</div>

<?php 
if(empty($unities)) {
	echo "<div class='span4 alert alert-info'>";
	echo "<h3>Não há tipos de unidades</h3>";
	echo "</div>";	
} else{?>

<div class="span10">
	<h2><?php echo __('Unidades');?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('cnes', 'CNES');?></th>
			<th><?php echo $this->Paginator->sort('cnpj', 'CNPJ');?></th>
			<th><?php echo $this->Paginator->sort('name', 'Nome');?></th>
			<th><?php echo $this->Paginator->sort('region_id', 'Região');?></th>
			<th><?php echo $this->Paginator->sort('health_district_id', 'Distrito sanitário');?></th>
			<th><?php echo $this->Paginator->sort('unity_type_id', 'Tipo da unidade');?></th>
			<th class="actions"><?php echo __('Ações');?></th>
		</tr>
	</thead>
	<tbody>		
	<?php
	foreach ($unities as $unity): ?>
	<tr>
		<td><?php echo h($unity['Unity']['cnes']); ?></td>
		<td><?php echo h($unity['Unity']['cnpj']); ?></td>
		<td><?php echo h($unity['Unity']['name']); ?></td>
		<td>
			<?php echo $this->Html->link($unity['Region']['id'], array('controller' => 'regions', 'action' => 'view', $unity['Region']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($unity['HealthDistrict']['name'], array('controller' => 'health_districts', 'action' => 'view', $unity['HealthDistrict']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($unity['UnityType']['name'], array('controller' => 'unity_types', 'action' => 'view', $unity['UnityType']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Visualizar'), array('action' => 'view', $unity['Unity']['id']), array('class'=>'btn btn-primary')); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $unity['Unity']['id']), array('class'=>'btn btn-primary')); ?>
			<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $unity['Unity']['id']), array('class'=>'btn btn-danger'), __('Deseja realmente deletar a unidade #%s?', $unity['Unity']['id'])); ?>
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
