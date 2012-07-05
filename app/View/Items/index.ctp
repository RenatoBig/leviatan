<div class="span2">	
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Novo Item'), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('PNGC'), array('controller' => 'pngc_codes', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Classe do item'), array('controller' => 'item_classes', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Pedidos'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		</ul>
	</div>
</div>

<?php 
if(empty($items)) {
	echo "<div class='span4 alert alert-info'>";
	echo "<h3>Não há items</h3>";
	echo "</div>";	
} else{?>
<div class="span8">
	<h2><?php echo __('Itens');?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
	<thead>
		<tr>
			<th><?php echo __('Nome');?></th>
			<th><?php echo __('Descrição');?></th>
			<th><?php echo __('Classe do item');?></th>
			<th><?php echo __('PNGC');?></th>			
			<th><?php echo __('Homologar');?></th>
			<th class="actions"><?php echo __('Ações');?></th>
		</tr>
	</thead>
	<tbody>
	<?php	
	foreach ($items as $item):
		$checked = $item['Item']['status_id'] != INATIVO ? 'checked="true"' : "";
		$disabled = 'disabled="disabled"';
		if($user['Group']['id'] == ADMIN || $user['Group']['id'] == NDE_A) {
			$disabled = "";
		}
	?>
		<tr>
			<td><?php echo h($item['Item']['name']); ?>&nbsp;</td>
			<td><?php echo h($item['Item']['description']); ?>&nbsp;</td>
			<td>
				<?php echo $this->Html->link($item['ItemClass']['name'], array('controller' => 'item_classes', 'action' => 'view', $item['ItemClass']['id'])); ?>
			</td>
			<td>
				<?php echo $this->Html->link($item['PngcCode']['keycode'], array('controller' => 'pngc_codes', 'action' => 'view', $item['PngcCode']['id'])); ?>
			</td>			
			<td> <input type="checkbox" class="enable" <?php echo $checked;?> <?php echo $disabled;?> value="<?php echo $item['Item']['id'] ?>" /></td>
			<td class="actions">
				<?php echo $this->Html->link(__('Visualizar'), array('action' => 'view', $item['Item']['id']), array('class'=>'btn  btn-primary')); ?>
				<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $item['Item']['id']), array('class'=>'btn  btn-primary')); ?>
				<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $item['Item']['id']), array('class'=>'btn  btn-danger'), __('Deseja realmente deletar o item #%s?', $item['Item']['name'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	
	<?php echo $this->element('pagination');?>
	
</div>
<?php 
}
?>
