<div class="span2 actions">
	<ul class="nav nav-list">
		<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
		<li><?php echo $this->Html->link(__('Solicitação'), array('controller' => 'solicitation_items', 'action' => 'index'), array('class'=>'btn')); ?> </li>
	</ul>
</div>
<div class="span10 index">
	
	<?php 
	if(empty($items)) {			
		echo "<div class='span4 alert alert-info'>";
		echo "<h3>Não há itens no carrinho</h3>";
		echo "</div>";			
	} else{
	?>

	<h2><?php echo __('Carrinho de compras');?></h2>
	<div class="well">				
		<table class="table">		
			<thead>
				<tr>
					<th><?php echo __('Nome')?></th>
					<th><?php echo __('Quantidade')?></th>
					<th><?php echo __('Ação')?></th>
				</tr>
			</thead>	
			<tbody>
				<?php
				foreach($items as $key=>$item): 
				?>
				<tr>
					<?php echo $this->Form->input('id', array('type'=>'hidden', 'value'=>$item['Item']['id'], 'name'=>'data[SolicitationItem]['.$key.'][item_id]'));?>
					<td><?php echo h($item['Item']['name']); ?></td>
					<td>
						<?php echo $this->Form->create('CartItem', array('url'=>'/cart_items/edit/'.$item['CartItem']['id']));?>
						<?php echo $this->Form->input('', array('maxLength'=>'4', 'class'=>'input-mini', 'name'=>'data[CartItem][quantity]', 'value'=>$item['CartItem']['quantity'] ,'type'=>'text', 'label'=>''));?>
						<?php echo $this->Form->button('Alterar quantidade')?>
						<?php echo $this->Form->end();?>
					</td>
					<td>
						<?php 
						echo $this->Form->postLink('Remover', 
								array('controller'=>'cart_items', 'action'=>'delete', $item['CartItem']['id']), 
								array('class'=>'btn btn-danger'), 
								"Deseja realmente retirar o item do carrinho?"
						);
						?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>		
		</table>
			<?php echo $this->element('pagination'); ?>
	</div>	
	<?php 
		echo $this->Form->postLink('Finalizar pedido', array('controller'=>'cart_items', 'action'=>'checkout'), array('class'=>'btn btn-primary'));
	}
	?>
</div>
