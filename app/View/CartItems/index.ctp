<div class="span9 well">

	<h2><?php echo __('Solicitação');?></h2>	
	<?php 
	if(empty($items)) {			
		echo "<div class='alert alert-info'>";
		echo "<h3>Não há itens</h3>";
		echo "</div>";			
	} else{
	?>
		<ul class="nav nav-tabs" id="myTab">
			<li class="active"><a title="Descrição da solicitação" href="#description"><?php echo __('Descrição')?></a></li>
			<li><a title="Itens da solicitação" href="#items"><?php echo __('Itens')?></a></li>
		</ul>		
		
		<div class="tab-content">
			
			<div class="tab-pane active" id="description">			
				<?php 
				echo $this->Form->input('Solicitation.memo_number', array('label'=>'Nº do memorando', 'class'=>'input-small'));						
				echo $this->Form->input('SolicitationDescription', array('label'=>''));
				echo $this->Fck->load('SolicitationDescription');
				?>				
			</div>
			
			<div class="tab-pane" id="items">
				<table class="table table-striped">		
					<thead>
						<tr>
							<th><?php echo __('Nome')?></th>
							<th><?php echo __('Quantidade')?></th>
							<th><?php echo __('Ação')?></th>
						</tr>
					</thead>	
					<tbody id="items">
						<?php
						foreach($items as $key=>$item): 
						?>
						<tr>
							<?php echo $this->Form->input('id', array('type'=>'hidden', 'value'=>$item['Item']['id'], 'name'=>'data[SolicitationItem]['.$key.'][item_id]'));?>
							<td><?php echo h($item['Item']['name']); ?></td>
							<td>
								<?php echo $this->Form->create('CartItem'); ?>
									<?php echo $this->Form->input('', array('maxLength'=>'4', 'class'=>'input-mini', 'name'=>'data[CartItem][quantity]', 'value'=>$item['CartItem']['quantity'] ,'type'=>'text', 'label'=>''));?>
									<?php echo $this->Form->button('Alterar', array('type'=>'button', 'class'=>'change-quantity', 'value'=>$item['CartItem']['id']));?>
								<?php echo $this->Form->end();?>
								<div id="busy-indicator">Loading ...</div>
							</td>							
							<td>
								<?php 
								echo $this->Form->input('Remover', 
										array(
											'label'=>'',
											'type'=>'button', 
											'class'=>'btn btn-danger delete_cart', 
											'title'=>'remover item',
											'value'=>$item['CartItem']['id']
										)
								);
								?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>							
				</table>
				<?php
				echo $this->Paginator->options(array(
						'update'=>'#items', 
						//'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array('buffer' => false)),
						//'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array('buffer' => false)),
					)
				); 
				echo $this->element('pagination'); 
				echo '<br><br>';
				echo $this->Form->button('Finalizar solicitação', array('type'=>'button', 'class'=>'btn btn-primary', 'id'=>'submitSolicitation', 'title'=>'Finaliza a solicitação'));
				?>			
			</div>		
			
		</div>	
	<?php		
	}
	?>
</div>
