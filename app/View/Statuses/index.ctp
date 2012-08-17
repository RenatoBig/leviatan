<?php 
if(empty($statuses)) {
	echo "<div class='alert alert-info'>";
	echo "<h3>Não há status</h3>";
	echo "</div>";	
} else{?>

<div class="span9 well">
	<h2><?php echo __('Status');?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('id', 'ID');?></th>
				<th><?php echo $this->Paginator->sort('name', 'Nome');?></th>
				<th><?php echo __('Ações');?></th>
			</tr>
		</thead>
		<tbody>		
		<?php
		foreach($statuses as $status): ?>
		<tr>
			<td><?php echo h($status['Status']['id']); ?>&nbsp;</td>
			<td><?php echo h($status['Status']['name']); ?>&nbsp;</td>
			<td>
				<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $status['Status']['id']), array('class'=>'btn', 'title'=>__('Editar status'))); ?>
				<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $status['Status']['id']), array('class'=>'btn btn-danger', 'title'=>__('Deletar status')), __('Deseja realmente deletar o status #%s?', $status['Status']['name'])); ?>
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
