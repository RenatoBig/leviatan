<?php echo $this->element('menu'); ?>
	
<div class="span9 well">
	
	<?php 
	echo $this->Form->create('Solicitation', array('class'=>''));
		echo $this->Form->input('status_id', array('label'=>'','options'=>$statuses, 'div'=>false));
	echo $this->Form->end(__('Filtrar'));
	
	echo '<h2>'.__('Minhas Solicitações').'</h2>';
	
	if(empty($solicitations)) {
		echo "<div class='alert alert-info'>";
		echo "<h3>Não há solicitações</h3>";
		echo "</div>";
	}else {?>
		<table cellpadding="0" cellspacing="0" class="table">
			<thead>
				<tr>
					<th><?php echo __('Número');?></th>
					<th><?php echo __('Data')?></th>
					<th><?php echo __('Situação');?></th>
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
						<?php 
						echo $this->Html->link(__('Visualizar'), 
							array('controller'=>'solicitations','action' => 'view', $solicitation['Solicitation']['id']), 
							array('class'=>'btn',
								'title'=>'Visualizar solicitação',
								'alt'=>'Visualizar'
							)							
						);						
						?> 
						<?php echo $this->Form->postLink(__('Imprimir'), array('controller'=>'solicitations','action' => 'printout', 'ext'=>'pdf',$solicitation['Solicitation']['id']), array('class'=>'btn'));?>
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
