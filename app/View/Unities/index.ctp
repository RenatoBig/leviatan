<?php 
if(empty($unities)) {
	echo "<div class='alert alert-info'>";
	echo "<h3>Não há tipos de unidades</h3>";
	echo "</div>";	
} else{?>

<div class="span9 well">
	<h2><?php echo __('Unidades');?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
		<thead>
			<tr>
				<th><?php echo __('CNES');?></th>
				<th><?php echo __('Nome');?></th>
				<th><?php echo __('Endereço');?></th>
				<th><?php echo __('Ações');?></th>
			</tr>
		</thead>
		<tbody>		
		<?php
		foreach ($unities as $unity): ?>
		<tr>
			<td><?php echo h($unity['Unity']['cnes']); ?></td>
			<td><?php echo $this->Html->link($unity['Unity']['name'], array('controller'=>'unities', 'action'=>'view', $unity['Unity']['id']), array('title'=>__('Visualizar dados da unidade'))); ?></td>
			<td>
				<?php
				if($unity['Unity']['number'] == '') {
					$unity['Unity']['number'] = 'S/N';
				}
				echo $this->Form->postLink($unity['Address']['name'], array('controller'=>'addresses', 'action'=>'view', $unity['Address']['id'])).
				' - '.
				$unity['Unity']['number'];
				?>
			</td>
			<td>
				<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $unity['Unity']['id']), array('class'=>'btn', 'title'=>__('Editar unidade'))); ?>
				<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $unity['Unity']['id']), array('class'=>'btn btn-danger', 'title'=>__('Deletar unidade')), __('Deseja realmente deletar a unidade #%s?', $unity['Unity']['id'])); ?>
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
