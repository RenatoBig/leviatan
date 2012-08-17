<div class="span2 well">
	<?php if($item['Item']['image_path']){
		echo $this->Html->image(
				'items/'.$item['Item']['image_path'], 
				array(
					'class'=>'space',
					'width'=>'170px',
					'height'=>'127px',
					'alt'=>$item['Item']['name'],
					'title'=>$item['Item']['name']						
				)
		);
	}else{
		echo $this->Html->image('no-image.gif', 
				array(
					'class'=>'space',
					'width'=>'170px',
					'height'=>'127px',
					'alt'=>'Sem imagem',
					'title'=>'Item não possui imagem'
				)
		);
	}?><br>
	<?php 
	if(in_array($item['Item']['id'], $cart_items)){ 
		echo '<i title="O item está no carrinho" class="icon-shopping-cart center"></i>';
	}elseif(in_array($item['Item']['id'], $solicitation_items)) {
		echo '<i title="O item está pendente, aguardando aprovação" class="icon-question-sign center"></i>';
	}else {
		echo $this->Form->postLink('Solicitar', array('controller'=>'cart_items', 'action'=>'add', $item['Item']['id']), array('class'=>'btn btn-primary', 'title'=>'Solicitar item'));
	} 
	?>
</div>

<div class="span9 well">
	<h3 class="ProductHeader"><?php echo $item['Item']['name']?></h3>
	
	<div style="padding-top:10px;">
		<h5>DESCRIÇÃO</h5>
		<textarea disabled="disabled" id="ItemDescription" rows="" cols=""><?php echo h($item['Item']['description']); ?></textarea>
		<?php echo $this->Fck->load('ItemDescription', 'None');?>	
	</div>	
	<div style="padding-top:10px">
		<h5>INFORMAÇÕES ADICIONAIS</h5>
		<textarea disabled="disabled" id="ItemSpecification" rows="" cols=""><?php echo h($item['Item']['specification']); ?></textarea>
		<?php echo $this->Fck->load('ItemSpecification', 'None');?>	
	</div>
</div>		

