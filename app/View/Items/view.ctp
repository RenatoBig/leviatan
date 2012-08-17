<div class="span2 well">
	<?php if($item['Item']['image_path']){
		echo $this->Html->image('items/'.$item['Item']['image_path'], array('class'=>'space','width'=>'170px','height'=>'127px'));
	}else{
		echo $this->Html->image('no-image.gif', array('class'=>'space','width'=>'170px','height'=>'127px'));
	}?><br>
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

