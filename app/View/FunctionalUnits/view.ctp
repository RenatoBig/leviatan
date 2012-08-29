<div class="span9 well">
	
	<dl class="dl-horizontal">
		<dt>Código </dt>
		<dd><?php echo $functionalUnit['FunctionalUnit']['keycode']?></dd>
		<dt>Nome </dt>
		<dd><?php echo $functionalUnit['FunctionalUnit']['name']?></dd>
		<dt>Descrição: </dt>
		<dd>		
			<textarea disabled="disabled" id="FunctionalUnitDescription" rows="" cols=""><?php echo h($functionalUnit['FunctionalUnit']['description']); ?></textarea>
			<?php echo $this->Fck->load('FunctionalUnitDescription', 'None');?>	
		</dd>
	</dl>	
	
</div>
