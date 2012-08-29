<div class="span9 well">
	<h2><?php echo __('Classe dos itens');?></h2>
	<?php 
	if(empty($itemClasses)) {
		echo "<div class='alert alert-info'>";
		echo "<h3>Não há items</h3>";
		echo "</div>";	
	} else{?>
		<table cellpadding="0" cellspacing="0" class="table">
			<thead>
				<tr>
					<th><?php echo $this->Paginator->sort('keycode', 'Código');?></th>
					<th><?php echo $this->Paginator->sort('name', 'Nome');?></th>
					<th><?php echo $this->Paginator->sort('item_group_id', 'Grupos dos itens');?></th>
					<th><?php echo __('Ações');?></th>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach ($itemClasses as $itemClass): ?>
			<tr>
				<td><?php echo h($itemClass['ItemClass']['keycode']); ?>&nbsp;</td>
				<td><?php echo h($itemClass['ItemClass']['name']); ?>&nbsp;</td>
				<td><?php echo $this->Html->link($itemClass['ItemGroup']['name'], array('controller' => 'item_groups', 'action' => 'view', $itemClass['ItemGroup']['id'])); ?></td>
				<td>
					<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $itemClass['ItemClass']['id']), array('class'=>'btn', 'title'=>__('Alterar a classe do item'))); ?>
					<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $itemClass['ItemClass']['id']), array('class'=>'btn btn-danger', 'title'=>'Deletar a classe do item'), __('Deseja realmente delear o item da classe #%s?', $itemClass['ItemClass']['name'])); ?>
				</td>
			</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		<?php echo $this->element('pagination');?>
	<?php }?>
</div>
