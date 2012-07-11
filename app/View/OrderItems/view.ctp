<div class="span2">
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Pedidos'), array('controller'=>'orders', 'action' => 'index')); ?></li>
		</ul>
	</div>
</div>	

<?php 
if(empty($orderItems)) {	
	echo "<div class='span4 alert alert-info'>";
	echo "<h3>Não há itens</h3>";
	echo "</div>";		
}else {?>
<div class="span10 well">	
	<h2><?php  echo __('Pedido');?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Pedido:'); ?></dt>
		<dd>
			<?php echo h($orderItems[0]['Order']['keycode']); ?>
		</dd>
		<dt><?php echo __('Data inicial:'); ?></dt>
		<dd>
			<?php echo h($orderItems[0]['Order']['start_date']); ?>
		</dd>
		<dt><?php echo __('Data final:'); ?></dt>
		<dd>			
			<?php 
				if($orderItems[0]['Order']['end_date'] != null) {
					echo h($orderItems[0]['Order']['end_date']);
				}else {
					echo '<span class="label label-info">Indefinida</span>';
				}
			?>
					
		</dd>
		<dt><?php echo __('Status:'); ?></dt>
		<dd>
			<?php echo $this->Utils->nameStatus($orderItems[0]['Order']['status_id']); ?>
		</dd>
	</dl>

	<h2><?php echo __('Itens do pedido');?></h2>	
	<table cellpadding="0" cellspacing="0" class="table">
	<thead>
		<tr>
			<th><?php echo __('Nome');?></th>
			<th><?php echo __('Descrição');?></th>
			<th><?php echo __('Imagem');?></th>
			<th><?php echo __('Quantidade');?></th>
			<th><?php echo __('Status');?></th>
		</tr>
	</thead>
	<tbody>
	<?php	
	foreach ($orderItems as $order): ?>
		<tr>
			<td><?php echo h($order['Item']['name']); ?>&nbsp;</td>
			<td><?php echo h($order['Item']['description']); ?>&nbsp;</td>
			<?php 
				if(empty($order['Item']['image_path'])){
					echo '<td>'.$this->Html->image('no-image.gif').'</td>';
				} else {
					echo '<td>'.$this->Html->image('items'.DS.$order['Item']['image_path']).'</td>';
				}
			?>
			<td><?php echo h($order['OrderItem']['quantity']); ?>&nbsp;</td>
			<td><?php echo $this->Utils->nameStatus($order['OrderItem']['status_id']); ?>&nbsp;</td>			
		</tr>
	<?php endforeach; ?>
	</tbody>
	<?php 
	}
	?>
</div>
