<div class="span2">
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Fazer solicitação'), array('controller'=>'solicitation_items', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('Solicitações pendentes'), array('controller'=>'solicitation_items', 'action' => 'pendingSolicitations')); ?></li>
			<li><?php echo $this->Html->link(__('Solicitações aprovadas'), array('controller'=>'solicitation_items', 'action' => 'approvedSolicitations')); ?></li>
		</ul>
	</div>
</div>
<div class="span10">
	
	<?php 
	if(empty($allItems)) {
		echo "<div class='span6 alert alert-info'>";
		echo "<h3>Não há solicitações negadas</h3>";
		echo "</div>";
	}else {?>	
	
	<?php 
	echo $this->Form->create('Item', array('class'=>''));
	 	echo $this->Form->input('item', array('label'=>'','options'=>$items));
	 	echo $this->Form->input('user', array('label'=>'','options'=>$users));
	 	echo $this->Form->input('solicitation', array('label'=>'','options'=>$solicitations));
	 echo $this->Form->end('Filtrar');
	?>
	
	<h2><?php echo __('Solicitações Negadas');?></h2>
		
	<table cellpadding="0" cellspacing="0" class="table" id="table">
	<thead>
		<tr>
			<th><?php echo __('Solicitação');?></th>
			<th><?php echo __('Item');?></th>
			<th><?php echo __('Descrição');?></th>
			<th><?php echo __('Quantidade');?></th>
			<th><?php echo __('Funcionário');?></th>
			<th><?php echo __('Unidade');?></th>
			<th><?php echo __('Setor');?></th>
		</tr>
	</thead>
	<tbody>
	<?php	
	foreach ($allItems as $key=>$item): ?>
		<tr id="trItem_<?php echo $key?>">
			<td><?php echo h($item['Solicitation']['keycode']); ?>&nbsp;</td>
			<td>
				<?php echo h($item['Item']['name']);?>
				&nbsp;
			</td>		
			<td>
				<?php echo h($item['Item']['description']) ?>
				&nbsp;
			</td>
			<td>
				<?php echo h($item['SolicitationItem']['quantity'])?>
				&nbsp;
			</td>
			<td>
				<?php echo h($item['Employee']['name'])?>
				&nbsp;
			</td>
			<td>
				<?php echo h($item['Unity']['name'])?>
				&nbsp;
			</td>
			<td>
				<?php echo h($item['Sector']['name'])?>
				&nbsp;
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
