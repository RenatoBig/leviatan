<div class="span2">
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Fazer pedido'), array('controller'=>'order_items', 'action' => 'products')); ?></li>
			<li><?php echo $this->Html->link(__('Usuários'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		</ul>
	</div>
</div>

<?php 
if(empty($orders)) {
	echo "<div class='span4 alert alert-info'>";
	echo "<h3>Não há pedidos</h3>";
	echo "</div>";
}else {?>
	
<div class="span10">
	<h2><?php echo __('Pedidos');?></h2>
		
	<table cellpadding="0" cellspacing="0" class="table">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('keycode', 'Código');?></th>
			<th><?php echo $this->Paginator->sort('user_id', 'Usuário');?></th>
			<th><?php echo $this->Paginator->sort('start_date', 'Data inicial');?></th>
			<th><?php echo $this->Paginator->sort('end_date', 'Data final');?></th>
			<th><?php echo $this->Paginator->sort('status_id', 'Status');?></th>
			<th class="actions"><?php echo __('Ações');?></th>
		</tr>
	</thead>
	<tbody>
	<?php	
	foreach ($orders as $order): ?>
		<tr>
			<td><?php echo h($order['Order']['keycode']); ?>&nbsp;</td>
			<td>
				<?php echo $this->Html->link($order['User']['Employee']['name'], array('controller' => 'users', 'action' => 'view', $order['User']['id'])); ?>
			</td>
			<td><?php echo h($order['Order']['start_date']); ?>&nbsp;</td>
			<?php 
			if($order['Order']['end_date'] == null) {
				echo '<td><span class="label label-info">Indefinida</span></td>';
			}else {				
			?>
			<td><?php echo h($order['Order']['end_date']); ?>&nbsp;</td>
			<?php 
			}
			?>
			<td>
				<?php echo $this->Html->link($order['Status']['name'], array('controller' => 'statuses', 'action' => 'view', $order['Status']['id'])); ?>
			</td>
			<td class="actions">
				<?php echo $this->Html->link(__('Visualizar'), array('controller'=>'order_items','action' => 'view', $order['Order']['id']), array('class'=>'btn btn-primary')); ?>
				<?php echo $this->Form->postLink(__('Deletar'), array('controller'=>'order_items', 'action' => 'delete', $order['Order']['id']), array('class'=>'btn btn-danger'), __('Deseja realmente deletar o pedido #%s?', $order['Order']['keycode'])); ?>
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
