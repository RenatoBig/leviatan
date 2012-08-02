<?php echo $this->element('menu'); ?>

<?php 
if(empty($items)) {	
	echo "<div class='alert alert-info'>";
	echo "<h3>Não há itens</h3>";
	echo "</div>";		
}else {?>
<div class="span9 well">	
	<ul class="nav nav-tabs" id="myTab">
		<li class="active"><a href="#solicitation"><?php echo __('Solicitação')?></a></li>
		<li><a href="#items"><?php echo __('Itens')?></a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="solicitation">
			<h2><?php  echo __('Solicitação');?></h2>
			<dl class="dl-horizontal">
				<dt><?php echo __('Número:'); ?></dt>
				<dd>
					<?php echo h($items[0]['Solicitation']['keycode']); ?>
				</dd>
				<dt><?php echo __('Descrição:'); ?></dt>
				<dd>
					<textarea disabled="disabled" id="SolicitationDescription" rows="" cols=""><?php echo h($items[0]['Solicitation']['description']); ?></textarea>
					<?php  echo $this->Fck->load('SolicitationDescription', 'None');?>
				</dd>
			</dl>
		</div>
		
		<div class="tab-pane" id="items">
			<h2><?php echo __('Itens da Solicitação');?></h2>	
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
					<td>
						<?php 
						echo $this->Form->postLink(
								h($item['Item']['name']),
								array(
									'controller'=>'items',
									'action'=>'view',
									$item['Item']['id']
								)
						);
						?>
						&nbsp;
					</td>
					<td><?php echo h($item['SolicitationItem']['quantity']); ?>&nbsp;</td>
					<td>
						<?php 
						if($item['SolicitationItem']['status_id'] == PENDENTE) {
							echo '<i title="Item pendente" class="icon-question-sign"></i>';
						}else if($item['SolicitationItem']['status_id'] == APROVADO) {
							echo '<i title="Item aprovado" class="icon-thumbs-up"></i>';	
						}else if($item['SolicitationItem']['status_id'] == NEGADO) {
							echo $this->Html->link(
								'<i class="icon-thumbs-down"></i>',
								'#',
								array('class'=>'denyVisualization', 
									  'value'=>$item['SolicitationItem']['id'],
									  'title'=>'Item negado. Clique para ver a justificativa.',
									  'escape'=>false
								)	
							);
						}
						?>
					</td>			
				</tr>
			<?php endforeach; ?>
			</tbody>
			<?php 
			}	
			?>
			</table>	
			<?php echo $this->element('pagination'); ?>		
		</div>
	</div>	
</div>

<div class="modal hide" id="myModal"></div>
