<?php echo $this->element('menu'); ?>
	
<div class="span9 well">
	<?php 
	if(empty($orders)) {
		echo "<div class='span4 alert alert-info'>";
		echo "<h3>Não há pedidos</h3>";
		echo "</div>";
	}else {?>
	
		<h2><?php echo __('Pedidos');?></h2>
			
		<table cellpadding="0" cellspacing="0" class="table">
			<thead>
				<tr>
					<th><?php echo __('Código');?></th>
					<th><?php echo __('Data');?>
					<th><?php echo __('Ação');?></th>
				</tr>
			</thead>
			<tbody>
			<?php	
			foreach ($orders as $order): ?>
				<tr>
					<td><?php echo h($order['Order']['keycode']); ?>&nbsp;</td>
					<td><?php echo $order['Order']['created'];?></td>
					<td>
						<?php echo $this->Html->link(__('Visualizar'), array('controller'=>'order_items','action' => 'view', $order['Order']['id']), array('class'=>'btn btn-primary')); ?>
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
