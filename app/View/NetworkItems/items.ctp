<div class="span2 actions">
	<ul class="nav nav-list">
		<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
		<li><?php echo $this->Html->link(__('Itens na rede'), array('controller'=>'network_items', 'action' => 'index'), array('class'=>'btn')); ?></li>
		<li><?php echo $this->Html->link(__('Solicitações aprovadas'), array('controller'=>'solicitation_items', 'action' => 'approvedSolicitations'), array('class'=>'btn')); ?></li>
		<li><?php echo $this->Html->link(__('Solicitações negadas'), array('controller'=>'solicitation_items', 'action' => 'deniedSolicitations'), array('class'=>'btn')); ?></li>
	</ul>
</div>
<div class="span10 index">
	
	<?php 
	if(empty($items)) {
		echo "<div class='span6 alert alert-info'>";
		echo "<h3>Não há itens para adicionar na rede</h3>";
		echo "</div>";
	}else {?>	
	
	<?php 
	//echo $this->Form->create('Item', array('class'=>''));
	 	//echo $this->Form->input('item', array('label'=>'','options'=>$items));
	 //	echo $this->Form->input('user', array('label'=>'','options'=>$users));
	 //	echo $this->Form->input('solicitation', array('label'=>'','options'=>$solicitations));
	// echo $this->Form->end('Filtrar');
	?>

	<h2><?php echo __('Itens disponíveis');?></h2>
		
	<table cellpadding="0" cellspacing="0" class="table" id="table">
	<thead>
		<tr>
			<th><?php echo __('Item');?></th>
			<th><?php echo __('Ação');?></th>
		</tr>
	</thead>
	<tbody>
	<?php	
	foreach ($items as $key=>$item): ?>
		<tr id="trItem_<?php echo $key?>">
			<td>
				<?php echo h($item['Item']['name']);?>
				&nbsp;
			</td>		
			<td>		
				<?php echo $this->Form->postLink('Jogar na rede', array('controller' => 'network_items', 'action' => 'add', $item['Item']['id']), array('class'=>'btn btn-info')); ?>
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
