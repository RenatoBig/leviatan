<div class="span9 well">
	<h2><?php echo __('Classe do item');?></h2>
	<br>
	<dl class="dl-horizontal">
		<dt>Grupo: </dt>
		<dd><?php echo $this->Html->link($itemClass['ItemGroup']['keycode'], array('controller'=>'item_groups', 'action'=>'view', $itemClass['ItemClass']['item_group_id']));?></dd>		
		<dt>Código</dt>
		<dd><?php echo $itemClass['ItemClass']['keycode']?></dd>
		<dt>Nome: </dt>
		<dd><?php echo $itemClass['ItemClass']['name']?></dd>
	</dl>	
</div>
