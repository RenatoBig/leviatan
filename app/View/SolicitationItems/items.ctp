<div class="span2 actions">
	<ul class="nav nav-list">
		<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
		<li class='divider'> </li>
		<li><?php echo $this->Form->postLink(__('Itens pendentes'), array('controller'=>'solicitation_items', 'action'=>'items', PENDENTE), array('class'=>'btn')); ?></li>
		<li><?php echo $this->Form->postLink(__('Itens aprovados'), array('controller'=>'solicitation_items', 'action'=>'items', APROVADO), array('class'=>'btn')); ?></li>
		<li><?php echo $this->Form->postLink(__('Itens homologados'), array('controller'=>'solicitation_items', 'action'=>'items', HOMOLOGADO), array('class'=>'btn')); ?></li>
		<li><?php echo $this->Form->postLink(__('Itens negados'), array('controller'=>'solicitation_items', 'action'=>'items', NEGADO), array('class'=>'btn')); ?></li>
	</ul>
</div>
<div class="span10 index">
	
	<?php 
	if(empty($allItems)) {
		echo "<div class='span6 alert alert-info'>";
		echo "<h3>Não há itens</h3>";
		echo "</div>";
	}else {?>	
	
	<?php 
	echo $this->Form->create('Item', array('class'=>''));
	 	echo $this->Form->input('item', array('label'=>'','options'=>$items));
	 	echo $this->Form->input('user', array('label'=>'','options'=>$users));
	 	echo $this->Form->input('solicitation', array('label'=>'','options'=>$solicitations));
	 echo $this->Form->end('Filtrar');
	?>
	
	<h2><?php echo __('Itens');?></h2>
		
	<table cellpadding="0" cellspacing="0" class="table" id="table">
		<thead>
			<tr>
				<th><?php echo __('Solicitação');?></th>
				<th><?php echo __('Item');?></th>
				<th><?php echo __('Quantidade');?></th>
				<th><?php echo __('Funcionário');?></th>
				<th><?php echo __('Unidade');?></th>
				<?php if($status == PENDENTE): ?>
					<th><?php echo __('Ações')?></th>
				<?php endif;?>
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
				<?php if($status == PENDENTE):?>
					<td>
						<?php 
						echo $this->Form->postLink('Aprovar', array('controller'=>'solicitation_items', 'action'=>'changeStatus', $item['SolicitationItem']['id'], APROVADO), array('class'=>'btn btn-primary'));
						echo '&nbsp';					
						echo $this->Form->postLink('Homologar', array('controller'=>'solicitation_items', 'action'=>'changeStatus', $item['SolicitationItem']['id'], HOMOLOGADO), array('class'=>'btn btn-success'));
						echo '&nbsp';
						echo $this->Form->postLink('Negar', array('controller'=>'solicitation_items', 'action'=>'changeStatus', $item['SolicitationItem']['id'], NEGADO), array('class'=>'btn btn-danger'));
						?>
					</td>
				<?php endif;?>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<?php
		echo $this->element('pagination'); 
		if($status == APROVADO) {
			echo $this->Form->postLink('Fechar pedido', array(
					'controller'=>'orders',
					'action'=>'add'),
					array('class'=>'btn btn-success'),
					'Todos os itens que estão aprovados serão agrupados em um único pedido. Deseja continuar?'
			);
		}
	}	
	?>
</div>
