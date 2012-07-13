<div class="span2">	
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Itens'), array('action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('PNGC'), array('controller' => 'pngc_codes', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Classe do item'), array('controller' => 'item_classes', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Pedidos'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		</ul>
	</div>
</div>

<div class="span6 well">
	<h2><?php  echo __('Item');?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($item['Item']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Classe do item'); ?></dt>
		<dd>
			<?php echo $this->Html->link($item['ItemClass']['name'], array('controller' => 'item_classes', 'action' => 'view', $item['ItemClass']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('PNGC'); ?></dt>
		<dd>
			<?php echo $this->Html->link($item['PngcCode']['keycode'], array('controller' => 'pngc_codes', 'action' => 'view', $item['PngcCode']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($item['Item']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Descrição'); ?></dt>
		<dd>
			<textarea disabled="disabled" id="ItemDescription" rows="" cols=""><?php echo h($item['Item']['description']); ?></textarea>
			<?php  echo $this->Fck->load('ItemDescription', 'None');?>			
		</dd>
		<dt><?php echo __('Imagem'); ?></dt>
		<dd>
			<?php 
				if(empty($item['Item']['image_path'])){
					echo $this->Html->image('no-image.gif');
				} else {
					echo $this->Html->image('items'.DS.$item['Item']['image_path']);
				}
			?>
			&nbsp;
		</dd>
		<dt><?php echo __('Criado'); ?></dt>
		<dd>
			<?php echo h($item['Item']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($item['Item']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
