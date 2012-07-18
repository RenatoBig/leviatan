<div class="span2 actions">
	<ul class="nav nav-list">
		<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
		<li class="divider"></li>
		<li><?php echo $this->Html->link(__('Fazer solicitação'), array('controller'=>'solicitation_items', 'action' => 'index'), array('class'=>'btn')); ?></li>
	</ul>
</div>
	
<div class="span10 index">
	<?php 
	if(empty($solicitations)) {
		echo "<div class='span4 alert alert-info'>";
		echo "<h3>Não há solicitações</h3>";
		echo "</div>";
	}else {?>
	
		<h2><?php echo __('Solicitações');?></h2>
			
		<table cellpadding="0" cellspacing="0" class="table">
			<thead>
				<tr>
					<th><?php echo __('Código');?></th>
					<th><?php echo __('Usuário');?></th>
					<th><?php echo __('Status');?></th>
					<th><?php echo __('Ações');?></th>
				</tr>
			</thead>
			<tbody>
			<?php	
			foreach ($solicitations as $solicitation): ?>
				<tr>
					<td><?php echo h($solicitation['Solicitation']['keycode']); ?>&nbsp;</td>
					<td>
						<?php echo $this->Html->link($solicitation['User']['Employee']['name'], array('controller' => 'users', 'action' => 'view', $solicitation['User']['id'])); ?>
					</td>		
					<td>
						<?php echo $this->Html->link($solicitation['Status']['name'], array('controller' => 'statuses', 'action' => 'view', $solicitation['Status']['id'])); ?>
					</td>
					<td>
						<?php echo $this->Html->link(__('Visualizar'), array('controller'=>'solicitations','action' => 'view', $solicitation['Solicitation']['id']), array('class'=>'btn btn-primary')); ?>
						<?php echo $this->Form->postLink(__('Deletar'), array('controller'=>'solicitations', 'action' => 'delete', $solicitation['Solicitation']['id']), array('class'=>'btn btn-danger'), __('Deseja realmente deletar o pedido #%s?', $solicitation['Solicitation']['keycode'])); ?>
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
