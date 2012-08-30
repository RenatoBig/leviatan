<div class="span9 well">	
	<h2><?php echo __('Itens');?></h2>
	<?php 
	if(empty($items)) {
		echo "<div class='alert alert-info'>";
		echo "<h3>Não há items</h3>";
		echo "</div>";	
	} else{?>
		<table cellpadding="0" cellspacing="0" class="table">
		<thead>
			<tr>
				<th><?php echo __('Habilitar');?></th>
				<th><?php echo __('Nome');?></th>
				<th><?php echo __('Classe');?></th>
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
					<?php 
					echo $this->Form->postLink($item['Item']['name'], array('controller'=>'items', 'action'=>'view', 'titulo'=>strtolower(Inflector::slug($item['Item']['name'], '-')), 'id'=>$item['Item']['id']));
					?>
				</td>
				<td>
					<?php echo $this->Html->link($item['ItemClass']['keycode'], array('controller' => 'item_classes', 'action' => 'view', $item['ItemClass']['id'])); ?>
				</td>
				<td>
					<?php echo $this->Html->link($item['PngcCode']['keycode'], array('controller' => 'pngc_codes', 'action' => 'view', $item['PngcCode']['id'])); ?>
				</td>			
				<td class="actions">
					<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $item['Item']['id']), array('class'=>'btn', 'title'=>'Editar o item')); ?>
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

