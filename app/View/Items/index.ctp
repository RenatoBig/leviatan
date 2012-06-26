<script type="text/javascript">

$(document).ready(function(){
	$("#autoComplete").autocomplete("items/autoComplete",
	{
		minChars: 2,
		cacheLength: 10,
		onItemSelect: selectItem,
		onFindValue: findValue,
		formatItem: formatItem,
 		autoFill: false
 	});
});
 
function selectItem(li) {
    findValue(li);
}
 
function findValue(li) {

    if( li == null ) 
        return alert("No match!");
 
	// if coming from an AJAX call, let's use the product id as the value
    if(!!li.extra ) { 
        var sValue = li.extra[0];
    } else {// otherwise, let's just display the value in the text box 
        var sValue = li.selectValue;
    }

}
 
function formatItem(row) {
    /*if(row[1] == undefined) {
        return row[0];
    }
    else {
        return row[0] + " (id: " + row[1] + ")";
    }*/
    return row[0];
}
</script>

<div class="items index" id="galeria">
	<div id="pesquisa">
		<form method="post" action="#">
			<fieldset>
				<input type="text" onfocus="if(this.value == 'Pesquisar itens') this.value = ''" onblur="if(this.value == '') this.value = 'Pesquisar itens'" name="data[Item][busca]" id="autoComplete" class="busca" value="Pesquisar itens">
				<input type="submit" name="pesquisar" title="Pesquisar" value="Pesquisar" onclick="if($('.busca').val() == 'Pesquisar itens') $('.busca').val('');">
			</fieldset>
		</form>
	</div>
	<h2><?php echo __('Itens');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id', 'ID');?></th>
			<th><?php echo $this->Paginator->sort('item_class_id', 'Classe do item');?></th>
			<th><?php echo $this->Paginator->sort('pngc_code_id', 'PNGC');?></th>
			<th><?php echo $this->Paginator->sort('name', 'Nome');?></th>
			<th><?php echo $this->Paginator->sort('description', 'Descrição');?></th>
			<th><?php echo $this->Paginator->sort('image_path', 'Imagem');?></th>
			<th><?php echo $this->Paginator->sort('created', 'Criado');?></th>
			<th><?php echo $this->Paginator->sort('modified', 'Modificado');?></th>
			<th class="actions"><?php echo __('Ações');?></th>
	</tr>
	<div id="main_table">
	<?php	
	foreach ($items as $item): ?>
		<tr>
			<td><?php echo h($item['Item']['id']); ?>&nbsp;</td>
			<td>
				<?php echo $this->Html->link($item['ItemClass']['name'], array('controller' => 'item_classes', 'action' => 'view', $item['ItemClass']['id'])); ?>
			</td>
			<td>
				<?php echo $this->Html->link($item['PngcCode']['keycode'], array('controller' => 'pngc_codes', 'action' => 'view', $item['PngcCode']['id'])); ?>
			</td>
			<td><?php echo h($item['Item']['name']); ?>&nbsp;</td>
			<td><?php echo h($item['Item']['description']); ?>&nbsp;</td>
			<td>
				<?php echo $this->Html->image('items'.DS.$item['Item']['image_path']); ?>&nbsp;
			</td>
			<td><?php echo h($item['Item']['created']); ?>&nbsp;</td>
			<td><?php echo h($item['Item']['modified']); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('Visualizar'), array('action' => 'view', $item['Item']['id'])); ?>
				<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $item['Item']['id'])); ?>
				<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $item['Item']['id']), null, __('Deseja realmente deletar o item #%s?', $item['Item']['name'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</div>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	
	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('anterior'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('próximo') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Novo item'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Listar classes dos itens'), array('controller' => 'item_classes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Noca classe do item'), array('controller' => 'item_classes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar códigos PNGCs'), array('controller' => 'pngc_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Noco código PNGC'), array('controller' => 'pngc_codes', 'action' => 'add')); ?> </li>
	</ul>
</div>
