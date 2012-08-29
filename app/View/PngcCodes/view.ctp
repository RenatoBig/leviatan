<div class="span9 well">
	<h2><?php echo __('PNGC');?></h2>
	<br>
	<dl class="dl-horizontal">
		<dt>Código</dt>
		<dd><?php echo $pngcCode['PngcCode']['keycode']?></dd>
		<dt>Grupo de gastos</dt>
		<dd><?php echo $pngcCode['ExpenseGroup']['name']?></dd>
		<dt>Categoria</dt>
		<dd><?php echo $inputCategory['InputCategory']['name']?></dd>
		<dt>Subcategoria</dt>
		<dd>
			<?php
			if($inputSubcategory['InputSubcategory'] == null) {
				echo '--';
			}else {
				echo $inputSubcategory['InputSubcategory']['name'];
			}			
			?>
		</dd>
		<dt>Medida</dt>
		<dd><?php echo $pngcCode['MeasureType']['name']?></dd>
	</dl>	
</div>