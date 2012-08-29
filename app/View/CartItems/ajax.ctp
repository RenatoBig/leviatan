<?php 
echo $this->fetch('script');
echo $this->Html->script(array('functions'));
?>
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