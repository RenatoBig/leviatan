<?php 
if(empty($unityTypes)) {
	echo "<div class='alert alert-info'>";
	echo "<h3>Não há tipos de unidades</h3>";
	echo "</div>";	
} else{?>
<div class="span9 well">
	<h2><?php echo __('Tipos das unidades');?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('name', 'Nome');?></th>
				<th><?php echo __('Ações');?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach ($unityTypes as $unityType): ?>
		<tr>
			<td><?php echo $this->Html->link($unityType['UnityType']['name'], array('controller'=>'unity_types', 'action'=>'view', $unityType['UnityType']['id']), array('title'=>'Visualizar dados do tipo da unidade'));?></td>
			<td>
				<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $unityType['UnityType']['id']), array('class'=>'btn', 'title'=>__('Editar tipo da unidade'))); ?>
				<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $unityType['UnityType']['id']), array('class'=>'btn btn-danger', 'title'=>__('Deletar tipo da unidade')), __('Deseja realmente deletar o tipo de unidade #%s?', $unityType['UnityType']['name'])); ?>
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
