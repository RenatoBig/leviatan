<?php echo $this->element('menu'); ?>

<div class="span9 well">
	
	<?php 
	if(empty($solicitationItems)) {
		echo "<div class='alert alert-info'>";
		echo "<h3>Não há itens</h3>";
		echo "</div>";
	}else {?>	
	
	<?php 
	echo $this->Form->create('SolicitationItem', array('class'=>''));
	 	echo $this->Form->input('status', array('label'=>'','options'=>$statuses));
	 echo $this->Form->end(__('Filtrar'));
	?>
	
	<h2><?php echo __('Itens');?></h2>
			
	<table cellpadding="0" cellspacing="0" class="table">
		<thead>
			<tr>
				<th><?php echo __('Item');?></th>
				<th><?php echo __('Quantidade');?></th>
				<th><?php echo __('Situação')?></th>
			</tr>
		</thead>
		<tbody>
		<?php	
		foreach ($solicitationItems as $key=>$item): ?>
			<tr>
				<td>
					<?php echo h($item['Item']['name']);?>
					&nbsp;
				</td>		
				<td>
					<?php echo h($item['SolicitationItem']['quantity'])?>
					&nbsp;
				</td>
				<td>
				<?php 
				if($item['SolicitationItem']['status_id'] == PENDENTE) {
					echo $this->Form->postLink('Aprovar', array('controller'=>'solicitation_items', 'action'=>'changeStatus', $item['SolicitationItem']['id'], APROVADO), array('class'=>'btn btn-primary'));
					echo '&nbsp';					
					echo $this->Html->link('Negar', '#', array('class'=>'btn btn-danger deny', 'value'=>$item['SolicitationItem']['id']));
				}else if($item['SolicitationItem']['status_id'] == APROVADO) {
					echo '<i class="icon-thumbs-up"></i>';	
				}else if($item['SolicitationItem']['status_id'] == NEGADO) {
					echo '<i class="icon-thumbs-down"></i>';
				}
				?>
				</td>
			</tr>
			
		<?php endforeach; ?>
		</tbody>
	</table>
	<?php
		echo $this->element('pagination');
		echo $this->Html->link('Voltar', array('controller'=>'solicitations', 'action'=>'solicitations'), array('class'=>'btn btn-primary'));
	}	
	?>
</div>
<div class="modal hide" id="myModal">
	<div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal">×</button>
    	<h3>Justificativa da negação</h3>
  	</div>
  	<div class="modal-body">
    	<?php echo $this->Form->create('Justification', array('controller'=>'justifications', 'action'=>'add'));?>
    		<?php echo $this->Form->input('solicitation_item_id', array('type'=>'hidden'))?>
    		<?php echo $this->Form->input('description', array('label'=>''));?>
    		<?php echo $this->Fck->load('JustificationDescription');?>    		
  	</div>
  	<div class="modal-footer">
    	<a href="#" class="btn" data-dismiss="modal">Fechar</a>
    		<?php echo $this->Form->button('Salvar', array('class'=>'btn btn-primary'))?>
	   	<?php echo $this->Form->end();?>
  	</div>
</div>
