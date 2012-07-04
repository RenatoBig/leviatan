<div class="span2">
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Usuários'), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Grupos'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Funcionários'), array('controller' => 'employees', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Pedidos'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		</ul>
	</div>
</div>

<div class="form-search" id="pesquisa">
		<form method="post" action="#">
			<fieldset>
				<input type="text" onfocus="if(this.value == 'Pesquisar itens') this.value = ''" onblur="if(this.value == '') this.value = 'Pesquisar itens'" name="data[Item][busca]" id="autoComplete" class="busca" value="Pesquisar itens">
				<input type="submit" name="pesquisar" title="Pesquisar" value="Pesquisar" onclick="if($('.busca').val() == 'Pesquisar itens') $('.busca').val('');">
			</fieldset>
		</form>
	</div>
<div class="span10">
	<div class="well">
		<table BORDER=0 CELLSPACING=0 CELLPADDING=0 COLS=1 WIDTH="100%" BGCOLOR="#0080C0" >
			<tr>
				<td>
				<center><b>Produtos</b></center>
				</td>
			</tr>
		</table>
		<table BORDER=0 COLS=4 WIDTH="100%" >
			<tr bgcolor="#cccccc">
				<td>
				<center>Descrição</center>
				</td>
				
				<td>
				<center>Codigo</center>
				</td>
				
				<td>
				<center>Imagem</center>
				</td>
								
				<td></td>
			</tr>
			<?php foreach($items as $item): ?>
				<tr BGCOLOR=#FFFFCC>
					<td align="center"><?php echo $item['Item']['name']?></td>
					<td align="center"><?php echo $item['Item']['name']?></td>
					<td align="center"><?php echo $this->Html->image('items'.DS.$item['Item']['image_path']); ?></td>
					<td BGCOLOR=#FFFFD7>
						<center><b><font size=-1><a href=carrinho.php?op=adicionar&id_prod=". $codproduto .">Colocar
						no carrinho!</a></font></b></center>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
	
	<div>
		<?php echo $this->Html->link(__('Finalizar compras'), array('action' => 'view', $item['Item']['id']), array('class'=>'btn btn-primary')); ?>
	</div>
</div>

<script type="text/javascript">

$(document).ready(function(){
	$("#autoComplete").autocomplete("/leviatan/items/autoComplete",
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
