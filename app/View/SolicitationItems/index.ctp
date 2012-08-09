<!--  <div class="menu center well SearchWell">
	<div class="input-append">
		<?php 
			/*echo $this->Form->create('Search', array(
				'url'=> array(
							'controller'=>'solicitation_items',
							'action'=>$action
						),
				'style'=>'margin-bottom:0px'));
			echo $this->Form->input('term',array('label'=>'','class'=>'span4','div'=>false));
			echo $this->Form->end(array('label'=>'Buscar', 'class'=>'btn', 'div'=>false));*/
		?>
	</div>
</div>-->
			
<?php echo $this->element('menu'); ?>

<div class="span9 well">	
	<?php 
	if(empty($items)) {
		echo "<div class='alert alert-info'>";
		echo "<h3>Não há itens</h3>";
		echo "</div>";
	}else {?>	
	
	<h2><?php echo __('Itens');?></h2>
		
	<table cellpadding="0" cellspacing="0" class="table">
		<thead>
			<tr>
				<th><?php echo __('Código');?></th>
				<th><?php echo __('Item');?></th>
				<th><?php echo __('Ação')?></th>
			</tr>
		</thead>
		<tbody>
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
								'action'=>'detail',
								$item['Item']['id']
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
					if(in_array($item['Item']['id'], $cart_items)){ 
						echo '<i title="Item está na lista de solicitados" alt="Item está na lista de solicitados" class="icon-shopping-cart center"></i>';
					}elseif(in_array($item['Item']['id'], $solicitation_items)) {
						echo '<i title="Item pendente. Aguardando aprovação" alt="Item pendente" class="icon-question-sign center"></i>';
					}else {
						echo $this->Form->postLink(
								'Solicitar', 
								array('controller'=>'cart_items', 'action'=>'add', $item['Item']['id']), 
								array(
									'class'=>'btn btn-primary',
									'title'=>'Solicitar item'
								)
						);
					} 
					?>
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