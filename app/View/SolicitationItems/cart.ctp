<div class="span2">
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Fazer solicitação'), array('controller' => 'solicitation_items', 'action' => 'index')); ?> </li>
		</ul>
	</div>
</div>
<?php 
if(empty($items)) {			
	echo "<div class='span4 alert alert-info'>";
	echo "<h3>Não há itens no carrinho</h3>";
	echo "</div>";			
} else{
?>
<div class="span10">
	<h2><?php echo __('Carrinho de compras');?></h2>
	<div class="well">
				
		<?php echo $this->Form->create('SolicitationItem', array('action' => 'checkout')) ?>
		<table class="table" id="table">		
			<thead>
				<tr>
					<th><?php echo __('Nome')?></th>
					<th><?php echo __('Descrição')?></th>
					<th><?php echo __('Imagem')?></th>
					<th><?php echo __('Quantidade')?></th>
					<th><?php echo __('Ação')?></th>
				</tr>
			</thead>	
			<tbody>
				<?php foreach($items as $key=>$item): ?>
				<tr id="tr_<?php echo $key; ?>">
					<?php echo $this->Form->input('id', array('type'=>'hidden', 'value'=>$item['Item']['id'], 'name'=>'data[SolicitationItem]['.$key.'][item_id]'));?>
					<td><?php echo h($item['Item']['name']); ?></td>
					<td><?php echo h($item['Item']['description']); ?></td>
					<?php 
					if(empty($item['Item']['image_path'])){
						echo '<td>'.$this->Html->image('no-image.gif').'</td>';
					} else {
						echo '<td>'.$this->Html->image('items'.DS.$item['Item']['image_path']).'</td>';
					}
					?>
					<td>
						<?php echo $this->Form->input('', array('maxLength'=>'4', 'value'=>'1', 'class'=>'input-mini', 'name'=>'data[SolicitationItem]['.$key.'][quantity]', 'type'=>'text', 'label'=>''));?>
					</td>
					<td>
						<?php echo $this->Form->button('Remover', array('label'=>'', 'type'=>'button', 'value'=>$item['Item']['id'].'-'.$key, 'class'=>'removeFromCart btn btn-danger'));?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>		
		</table>
			<?php echo $this->Form->end(array('label'=>'Finalizar pedido', 'class'=>'btn btn-primary'));?>
	</div>	
	<?php 
	}
	?>
</div>
