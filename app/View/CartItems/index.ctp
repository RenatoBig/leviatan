<?php echo $this->element('menu'); ?>

<div class="span9 well">
	
	<?php 
	if(empty($items)) {			
		echo "<div class='alert alert-info'>";
		echo "<h3>Não há itens no carrinho</h3>";
		echo "</div>";			
	} else{
	?>

	<h2><?php echo __('Solicitação');?></h2>	
		
	<ul class="nav nav-tabs" id="myTab">
		<li class="active"><a title="Descrição da solicitação" href="#description"><?php echo __('Descrição')?></a></li>
		<li><a title="Itens da solicitação" href="#items"><?php echo __('Itens')?></a></li>
	</ul>		
	
	<div class="tab-content">
		
		<div class="tab-pane active" id="description">			
			<?php 
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
				<tbody>
					<?php
					foreach($items as $key=>$item): 
					?>
					<tr>
						<?php echo $this->Form->input('id', array('type'=>'hidden', 'value'=>$item['Item']['id'], 'name'=>'data[SolicitationItem]['.$key.'][item_id]'));?>
						<td><?php echo h($item['Item']['name']); ?></td>
						<td>
							<?php echo $this->Form->create('CartItem'); ?>
							<?php echo $this->Form->input('', array('maxLength'=>'4', 'class'=>'input-mini', 'name'=>'data[CartItem][quantity]', 'value'=>$item['CartItem']['quantity'] ,'type'=>'text', 'label'=>''));?>
							<?php echo $this->Js->submit('Alterar', array(
										'url'=>array(
												'controller'=>'cart_items',
												'action'=>'edit',
												$item['CartItem']['id']
											),
										'update'=>'#alert-message'
									)
								);
							?>
							<?php echo $this->Form->end();?>
						</td>
						<td>
							<?php 
							echo $this->Form->postLink('Remover', 
									array('controller'=>'cart_items', 'action'=>'delete', $item['CartItem']['id']), 
									array('class'=>'btn btn-danger', 'title'=>'Remover item'), 
									"Deseja realmente retirar o item do carrinho?"
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