<?php 
if(empty($sectors)) {
	echo "<div class='alert alert-info'>";
	echo "<h3>Não há setores cadastrados</h3>";
	echo "</div>";	
} else{?>
<div class="span9 well">
	<h2><?php echo __('Setores');?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('name', 'Nome');?></th>
			<th><?php echo __('Ações');?></th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach ($sectors as $sector): ?>
	<tr>
		<td><?php echo h($sector['Sector']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $sector['Sector']['id']), array('class'=>'btn', 'title'=>__('Editar o setor'))); ?>
			<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $sector['Sector']['id']), array('class'=>'btn btn-danger', 'title'=>__('Deletar o setor')), __('Deseja realmente deletar o setor #%s?', $sector['Sector']['name'])); ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</tbody>
	</table>

	<?php echo $this->element('pagination');?>
</div>
<?php 
}
?>
