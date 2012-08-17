<div class="span9 well">
	<?php 
	if(empty($solicitations)) {
		echo "<div class='span4 alert alert-info'>";
		echo "<h3>Não há itens</h3>";
		echo "</div>";
	}else {?>
	
		<h2><?php echo __('Solicitações');?></h2>
			
		<table cellpadding="0" cellspacing="0" class="table">
			<thead>
				<tr>
					<th><?php echo __('Código');?></th>
					<th><?php echo __('Funcionário')?></th>
					<th><?php echo __('Unidade')?></th>
					<th><?php echo __('Data da solicitação')?></th>
					<th><?php echo __('Ações');?></th>
				</tr>
			</thead>
			<tbody>
			<?php	
			foreach ($solicitations as $solicitation): ?>
				<tr>
					<td><?php echo h($solicitation['Solicitation']['keycode']); ?>&nbsp;</td>
					<td><?php echo h($solicitation['Employee']['name'])?>&nbsp;</td>
					<td><?php echo h($solicitation['Unity']['name'])?>&nbsp;</td>
					<td><?php echo h($solicitation['Solicitation']['created'])?>&nbsp;</td>
					<td>
						<?php echo $this->Html->link(__('Visualizar'), array('controller'=>'solicitations','action' => 'view', $solicitation['Solicitation']['id']), array('class'=>'btn btn-primary')); ?>
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
