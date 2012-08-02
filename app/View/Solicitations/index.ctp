<?php echo $this->element('menu'); ?>
	
<div class="span9 well">
	<?php 
	if(empty($solicitations)) {
		echo "<div class='alert alert-info'>";
		echo "<h3>Não há solicitações</h3>";
		echo "</div>";
	}else {?>
	
		<h2><?php echo __('Minhas Solicitações');?></h2>
			
		<table cellpadding="0" cellspacing="0" class="table">
			<thead>
				<tr>
					<th><?php echo __('Número');?></th>
					<th><?php echo __('Data')?></th>
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
						<?php echo $solicitation['Solicitation']['created'];?>
					</td>
					<td>
						<?php echo h(__($solicitation['Status']['name'])); ?>
					</td>
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
