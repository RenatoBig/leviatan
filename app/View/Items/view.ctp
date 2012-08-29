<div class="span9 well">
	<h2><?php echo __('Item');?></h2>
	<br><br><br>
	<dl class="dl-horizontal">
		<dt>Imagem</dt>
		<dd>
		<?php if($item['Item']['image_path']){
			echo $this->Html->image('items/'.$item['Item']['image_path'], array('class'=>'space','width'=>'170px','height'=>'127px'));
		}else{
			echo $this->Html->image('no-image.gif', array('class'=>'space','width'=>'170px','height'=>'127px'));
		}?>
		</dd>
		<dt>Código</dt>
		<dd><?php echo $item['Item']['keycode']?></dd>
		<dt>Nome </dt>
		<dd><?php echo $item['Item']['name']?></dd>
		<dt>Descrição</dt>
		<dd>		
			<textarea disabled="disabled" id="ItemDescription" rows="" cols=""><?php echo h($item['Item']['description']); ?></textarea>
			<?php echo $this->Fck->load('ItemDescription', 'None');?>
		</dd>
		<dt>Informações adicionais</dt>
		<dd>
		<textarea disabled="disabled" id="ItemSpecification" rows="" cols=""><?php echo h($item['Item']['specification']); ?></textarea>
		<?php echo $this->Fck->load('ItemSpecification', 'None');?>
		</dd>		
	</dl>		
</div>