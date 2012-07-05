<div class="span2">
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Adicionar Distrito sanitário'), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('Unidades'), array('controller'=>'unities', 'action' => 'index')); ?></li>
		</ul>
	</div>
</div>

<?php 
if(empty($healthDistricts)) {
	echo "<div class='span4 alert alert-info'>";
	echo "<h3>Não há distritos sanitários cadastrados</h3>";
	echo "</div>";	
} else{?>
<div class="span6">
	<h2><?php echo __('Distritos sanitários');?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
	<thead>
		<tr>	
			<th><?php echo $this->Paginator->sort('name', 'Nome');?></th>
			<th class="actions"><?php echo __('Ações');?></th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach ($healthDistricts as $healthDistrict): ?>
	<tr>
		<td><?php echo h($healthDistrict['HealthDistrict']['name']); ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('Visualizar'), array('action' => 'view', $healthDistrict['HealthDistrict']['id']), array('class'=>'btn btn-primary')); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $healthDistrict['HealthDistrict']['id']), array('class'=>'btn btn-primary')); ?>
			<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $healthDistrict['HealthDistrict']['id']), array('class'=>'btn btn-danger'), __('Deseja realmente deletar o distrito sanitário #%s?', $healthDistrict['HealthDistrict']['name'])); ?>
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
