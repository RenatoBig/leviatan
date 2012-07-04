<div class="span2">
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Usuários'), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Grupos'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Funcionários'), array('controller' => 'employees', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Carrinho'), array('controller' => 'order_items', 'action' => 'cart')); ?> </li>
		</ul>
	</div>
</div>

<div class="span10">
	<h2><?php echo __('Itens');?></h2>
	<div class="well">
		<table class="table">		
			<thead>
				<tr>
					<th><?php echo __('Nome')?></th>
					<th><?php echo __('Descrição')?></th>
					<th><?php echo __('Imagem')?></th>
					<th></th>
				</tr>
			</thead>	
			<tbody>
				<?php foreach($items as $item): ?>
				<tr>
					<td><?php echo h($item['Item']['name']); ?></td>
					<td><?php echo h($item['Item']['description']); ?></td>
					<?php 
					if(empty($item['Item']['image_path'])){
						echo '<td>'.$this->Html->image('no-image.gif').'</td>';
					} else {
						echo '<td>'.$this->Html->image('items'.DS.$item['Item']['image_path']).'</td>';
					}
					?>
					<td>
						<?php echo $this->Form->postLink(__('Adicionar ao carrinho'), array('action' => 'products', $item['Item']['id']), array('class'=>'btn btn-primary')); ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>		
		</table>	
	</div>
</div>
