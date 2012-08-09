<?php echo $this->element('menu'); ?>

<div class="span9 well">
	<?php 
	if(empty($solicitations)) {
		echo "<div class='alert alert-info'>";
		echo "<h3>Não há solicitações</h3>";
		echo "</div>";
	}else {?>	
		<h2><?php echo __('Solicitações');?></h2>
		<br>
		<table cellpadding="0" cellspacing="0" class="table table-striped">
			<thead>
				<tr>
					<th><?php echo __('Número');?></th>
					<th><?php echo __('Usuário');?></th>
					<th><?php echo __('Unidade');?></th>
					<th><?php echo __('Setor');?></th>
					<th><?php echo __('Data');?></th>
					<th><?php echo __('Situação');?></th>
				</tr>
			</thead>
			<tbody id="content">
			<?php	
			foreach ($solicitations as $solicitation): ?>
				<tr>
					<td>
						<?php echo $this->Html->link(
								h($solicitation['Solicitation']['keycode']),
								array('controller'=>'solicitation_items', 'action'=>'all_items', $solicitation['Solicitation']['id']),
								array('title'=>'Clique para ver os itens solicitados')
								);?>
						&nbsp;
					</td>
					<td>
						<?php echo h(__($solicitation['Employee']['name'])); ?>
					</td>		
					<td>
						<?php echo h(__($solicitation['Unity']['name'])); ?>
					</td>
					<td>
						<?php echo h(__($solicitation['Sector']['name'])); ?>
					</td>
					<td>
						<?php echo $solicitation['Solicitation']['created']; ?>
					</td>
					<td>
						<?php 
						if(in_array($solicitation['Solicitation']['id'], $pendingSolicitations)){
							echo '<i title="Posssui itens pendentes nesta solicitação" class="icon-question-sign"></i>';
						} else{
							echo '<i title="Não possui itens pendentes" class="icon-ok"></i>';								
						}
						?>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	<?php		 
		echo $this->element('pagination'); 
		echo $this->Form->postLink('Gerar pedido', array('controller'=>'orders', 'action'=>'add'), array('class'=>'btn', 'title'=>'Gera o pedido'));	
	}
	?>
	
</div>
