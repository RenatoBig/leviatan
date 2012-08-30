<div class="span9 well">
	<?php 
	if(empty($items)) {
		echo "<div class='alert alert-info'>";
		echo "<h3>Não há items</h3>";
		echo "</div>";	
	} else{?>
	<h2><?php echo __('Itens');?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
	<thead>
		<tr>
			<th><?php echo __('Código')?></th>
			<th><?php echo __('Nome');?></th>
			<th><?php echo __('Classe do item');?></th>
			<th><?php echo __('PNGC');?></th>			
		</tr>
	</thead>
	<tbody>
	<?php	
	foreach ($items as $item):
	?>
		<tr>
			<td><?php echo $item['Item']['keycode']?></td>
			<td>
				<?php 
				echo $this->Form->postLink($item['Item']['name'], array('action'=>'home', 'titulo'=>strtolower(Inflector::slug($item['Item']['name'], '-')), 'id'=>$item['Item']['id']));
				?>
			</td>
			<td>
				<?php echo $this->Html->link(
						$item['ItemClass']['keycode'],
						array('controller'=>'item_classes', 'action'=>'view', $item['ItemClass']['id'])
						); 
				?>
			</td>
			<td>
				<?php echo $this->Html->link(
						$item['PngcCode']['keycode'],
						array('controller'=>'pngc_codes', 'action'=>'view', $item['PngcCode']['id'])
						);  ?>
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