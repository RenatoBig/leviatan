<div class="span2">
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Solicitações'), array('controller'=>'solicitations', 'action' => 'index')); ?></li>
		</ul>
	</div>
</div>	

<?php 
if(empty($items)) {	
	echo "<div class='span4 alert alert-info'>";
	echo "<h3>Não há itens</h3>";
	echo "</div>";		
}else {?>
<div class="span10 well">	
	<h2><?php  echo __('Solicitação');?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Pedido:'); ?></dt>
		<dd>
			<?php echo h($items[0]['Solicitation']['keycode']); ?>
		</dd>
		<dt><?php echo __('Status:'); ?></dt>
		<dd>
			<?php echo $this->Utils->nameStatus($items[0]['Solicitation']['status_id']); ?>
		</dd>
	</dl>

	<h2><?php echo __('Itens do Solicitação');?></h2>	
	<table cellpadding="0" cellspacing="0" class="table">
	<thead>
		<tr>
			<th><?php echo __('Nome');?></th>
			<th><?php echo __('Quantidade');?></th>
			<th><?php echo __('Status');?></th>
		</tr>
	</thead>
	<tbody>
	<?php	
	foreach ($items as $item): ?>
		<tr>
			<td><?php echo h($item['Item']['name']); ?>&nbsp;</td>
			<td><?php echo h($item['SolicitationItem']['quantity']); ?>&nbsp;</td>
			<td><?php echo $this->Utils->nameStatus($item['SolicitationItem']['status_id']); ?>&nbsp;</td>			
		</tr>
	<?php endforeach; ?>
	</tbody>
	<?php 
	}	
	?>
	</table>	
	<?php echo $this->element('pagination'); ?>
</div>

