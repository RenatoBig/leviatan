<h2><?php echo __('Itens');?></h2>		
<?php 
if(empty($items)) {
	echo "<div class='alert alert-info'>";
	echo "<h3>Não há itens</h3>";
	echo "</div>";
}else {?>		
	<table cellpadding="0" cellspacing="0" class="table">
		<thead>
			<tr>
				<th><?php echo __('Código');?></th>
				<th><?php echo __('Item');?></th>
				<th><?php echo __('Classe do item');?></th>
				<th><?php echo __('Ação')?></th>
			</tr>
		</thead>
		<tbody id="items">
		<?php	
		foreach ($items as $key=>$item): ?>
			<tr>
				<td>
					<?php echo h($item['Item']['keycode']); ?>
					&nbsp;
				</td>
				<td>
					<?php 
					echo $this->Form->postLink(
							h($item['Item']['name']),
							array(
								'controller'=>'items',
								'action'=>'view',
								'titulo'=>strtolower(Inflector::slug($item['Item']['name'], '-')), 
								'id'=>$item['Item']['id']
							),
							array(
								'title'=>'Clique para ver detalhes do item'		
							)
					);
					?>
					&nbsp;
				</td>		
				<td>
					<?php 
					echo $this->Form->postLink(
						$item['ItemClass']['keycode'],
						array(
							'controller'=>'item_classes', 
							'action'=>'view',
							'id'=>$item['Item']['item_class_id'],
							'titulo'=>$item['Item']['name']	
						)
					);
					?>
				</td>
				<td>
					<?php 
					if(in_array($item['Item']['id'], $cart_items)){ 
						echo '<i title="Item está na lista de solicitados" alt="Item está na lista de solicitados" class="icon-shopping-cart center"></i>';
					}elseif(in_array($item['Item']['id'], $solicitation_items)) {
						echo '<i title="Item pendente. Aguardando aprovação" alt="Item pendente" class="icon-question-sign center"></i>';
					}else {
						echo $this->Form->input('Solicitar item', array('label'=>'', 'class'=>'btn request', 'value'=>$item['Item']['id'], 'type'=>'button'));
					} 
					?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

<?php
	echo $this->Paginator->options(array(
			'update'=>'#html',
			'evalScripts' => true
		)
	);
	echo $this->element('pagination');		
}	
?>