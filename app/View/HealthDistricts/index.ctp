<?php 
if(empty($healthDistricts)) {
	echo "<div class='alert alert-info'>";
	echo "<h3>Não há distritos sanitários cadastrados</h3>";
	echo "</div>";	
} else{?>
<div class="span9 well">
	<h2><?php echo __('Distritos sanitários');?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
		<thead>
			<tr>	
				<th><?php echo $this->Paginator->sort('name', 'Nome');?></th>
				<th><?php echo __('Ações');?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach ($healthDistricts as $healthDistrict): ?>
		<tr>
			<td><?php echo h($healthDistrict['HealthDistrict']['name']); ?></td>
			<td>
				<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $healthDistrict['HealthDistrict']['id']), array('class'=>'btn', 'title'=>__('Editar distrito sanitário'))); ?>
				<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $healthDistrict['HealthDistrict']['id']), array('class'=>'btn btn-danger', 'title'=>__('Deletar distrito sanitário')), __('Deseja realmente deletar o distrito sanitário #%s?', $healthDistrict['HealthDistrict']['name'])); ?>
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
