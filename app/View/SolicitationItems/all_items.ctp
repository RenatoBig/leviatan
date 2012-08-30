<div class="span9 well">
	<?php 
	echo $this->Form->create('SolicitationItem', array('class'=>''));
	 	echo $this->Form->input('status', array('label'=>'','options'=>$statuses));
	 echo $this->Form->end(__('Filtrar'));
	?>
	
	<h2><?php echo __('Itens');?></h2>
	
	<?php 
	if(empty($solicitationItems)) {
		echo "<div class='alert alert-info'>";
		echo "<h3>Não há itens</h3>";
		echo "</div>";
	}else {?>	
			
	<table cellpadding="0" cellspacing="0" class="table">
		<thead>
			<tr>
				<th><?php echo $this->Form->checkbox('selectAll', array('id'=>'selectAll'))?></th>
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
					<?php echo $this->Form->checkbox('checkItem', array('value'=>$item['SolicitationItem']['id'], 'class'=>'check-items'));?>
				</td>
				<td>
					<?php 
					echo $this->Form->postLink($item['Item']['name'], array('controller'=>'items', 'action'=>'view', 'titulo'=>strtolower(Inflector::slug($item['Item']['name'], '-')), 'id'=>$item['Item']['id']));
					?>
					&nbsp;
				</td>		
				<td>
					<?php echo h($item['SolicitationItem']['quantity'])?>
					&nbsp;
				</td>
				<td id=<?php echo $item['SolicitationItem']['id'];?>>
				<?php 
				if($item['SolicitationItem']['status_id'] == PENDENTE) {
					echo $this->Form->input('Aprovar', array(
							'div'=>false,
							'label'=>'',
							'type'=>'button',
							'class'=>'btn btn-primary approved-item',
							'value'=>$item['SolicitationItem']['id'].'-'.APROVADO
						)
					);
					echo '&nbsp';					
					echo $this->Html->link('Negar', '#', array('class'=>'btn btn-danger deny', 'title'=>'Negar o item', 'value'=>$item['SolicitationItem']['id']));
				}else if($item['SolicitationItem']['status_id'] == APROVADO) {
					echo '<i title="Item aprovado" class="icon-thumbs-up"></i>';	
				}else if($item['SolicitationItem']['status_id'] == NEGADO) {
					echo $this->Html->link(
						'<i class="icon-thumbs-down"></i>',
						'#',
						array('class'=>'denyVisualization', 
							  'value'=>$item['SolicitationItem']['id'],
							  'title'=>'Item negado. Clique para ver a justificativa.',
							  'alt'=>'Negado',
							  'escape'=>false
						)	
					);
				}
				?>
				</td>
			</tr>
			
		<?php endforeach; ?>
		</tbody>
	</table>
	<?php
		echo $this->Form->input('Aprovar selecionados', array('label'=>'', 'class'=>'btn btn-primary approved-selected', 'type'=>'button'));
		//echo $this->Html->link('Voltar', array('controller'=>'solicitations', 'action'=>'all'), array('class'=>'btn btn-primary'));
		echo $this->element('pagination');
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
