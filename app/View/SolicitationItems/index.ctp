<div class="menu center well SearchWell">
	<div class="input-append">
		<?php 
			echo $this->Form->create('Search', array(
				'url'=> array(
							'controller'=>'solicitation_items',
							'action'=>$action
						),
				'style'=>'margin-bottom:0px'));
			echo $this->Form->input('term',array('label'=>'','class'=>'span4','div'=>false));
			echo $this->Form->end(array('label'=>'Buscar', 'class'=>'btn', 'div'=>false));
		?>
	</div>
</div>	
<div class="span2 actions">
	<ul class="nav nav-list">
		<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
		<li class="divider"></li>
		<li><?php echo $this->Html->link('Solicitados por todos', array('controller'=>'solicitation_items', 'action'=>'requestedItems'), array('class'=>'btn'));?></li>
		<li><?php echo $this->Html->link('Fazer solicitação', array('controller'=>'solicitation_items', 'action'=>'index'), array('class'=>'btn'));?></li>
		<li><?php echo $this->Html->link('Carrinho', array('controller'=>'cart_items', 'action'=>'index'), array('class'=>'btn'));?></li>
	</ul>	
</div>
<div class="span6 index">	
	<?php 
	if(empty($items)) {
		echo "<div class='span6 alert alert-info'>";
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
								'action'=>'details',
								$item['Item']['id']
							)
					);
					?>
					&nbsp;
				</td>		
				<td>
					<?php 
					if(in_array($item['Item']['id'], $cart_items)){ 
						echo '<i class="icon-shopping-cart center"></i>';
					}elseif(in_array($item['Item']['id'], $solicitation_items)) {
						echo '<i class="icon-question-sign center"></i>';
					}else {
						echo $this->Form->postLink('Solicitar', array('controller'=>'cart_items', 'action'=>'add', $item['Item']['id']), array('class'=>'btn btn-primary'));
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