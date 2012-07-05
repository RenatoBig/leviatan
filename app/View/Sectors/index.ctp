<div class="span2">
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Adicionar setor'), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('Unidades setores'), array('controller'=>'unity_sectors', 'action' => 'index')); ?></li>
		</ul>
	</div>
</div>

<?php 
if(empty($sectors)) {
	echo "<div class='span4 alert alert-info'>";
	echo "<h3>Não há setores cadastrados</h3>";
	echo "</div>";	
} else{?>
<div class="span6">
	<h2><?php echo __('Setores');?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('name', 'Nome');?></th>
			<th class="actions"><?php echo __('Ações');?></th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach ($sectors as $sector): ?>
	<tr>
		<td><?php echo h($sector['Sector']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Visualizar'), array('action' => 'view', $sector['Sector']['id']), array('class'=>'btn btn-primary')); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $sector['Sector']['id']), array('class'=>'btn btn-primary')); ?>
			<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $sector['Sector']['id']), array('class'=>'btn btn-danger'), __('Deseja realmente deletar o setor #%s?', $sector['Sector']['name'])); ?>
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
