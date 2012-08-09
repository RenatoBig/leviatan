<?php echo $this->element('menu'); ?>

<div class="span9 well">
	<?php 
	if(empty($items)) {
		echo "<div class='span4 alert alert-info'>";
		echo "<h3>Não há items</h3>";
		echo "</div>";	
	} else{?>
	<h2><?php echo __('Itens');?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
	<thead>
		<tr>
			<th><?php echo __('Habilitar');?></th>
			<th><?php echo __('Nome');?></th>
			<th><?php echo __('Classe do item');?></th>
			<th><?php echo __('PNGC');?></th>			
			<th><?php echo __('Ações');?></th>
		</tr>
	</thead>
	<tbody>
	<?php	
	foreach ($items as $item):
		$checked = $item['Item']['status_id'] != INATIVO ? 'checked="true"' : "";
		$disabled = 'disabled="disabled"';
		if($user['Group']['id'] == ADMIN || $user['Group']['id'] == NDE_A) {
			$disabled = "";
		}
	?>
		<tr>
			<td><input title="Habilita/desabilita item para solicitação" type="checkbox" class="enable" <?php echo $checked;?> <?php echo $disabled;?> value="<?php echo $item['Item']['id'] ?>" /></td>
			<td>
				<?php echo $this->Html->link(
						h($item['Item']['name']), 
						array('action' => 'view', $item['Item']['id']),
						array('title'=>'Clique para ver detalhes do item')
					); 
				?>
			</td>
			<td>
				<?php echo $this->Html->link($item['ItemClass']['name'], array('controller' => 'item_classes', 'action' => 'view', $item['ItemClass']['id'])); ?>
			</td>
			<td>
				<?php echo $this->Html->link($item['PngcCode']['keycode'], array('controller' => 'pngc_codes', 'action' => 'view', $item['PngcCode']['id'])); ?>
			</td>			
			<td class="actions">
				<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $item['Item']['id']), array('class'=>'btn  btn-primary', 'title'=>'Editar o item')); ?>
				<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $item['Item']['id']), array('class'=>'btn  btn-danger', 'title'=>'Deletar o item'), __('Deseja realmente deletar o item #%s?', $item['Item']['name'])); ?>
			</td>
		</tr>		
	<?php endforeach; ?>
	</tbody>
	</table>
	<?php 
	echo $this->element('pagination');	
	}
	?>
</div>

