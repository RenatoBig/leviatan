<div class="span2 actions">
	<ul class="nav nav-list">
		<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
		<li><?php echo $this->Html->link(__('Carrinho'), array('controller' => 'cart_items', 'action' => 'index'), array('class'=>'btn')); ?> </li>
	</ul>
</div>

<div class="span10 index">
	<?php 
	if(empty($items)) {			
		echo "<div class='span4 alert alert-info'>";
		echo "<h3>Não há itens</h3>";
		echo "</div>";			
	} else{
	?>
	
	<h2><?php echo __('Itens');?></h2>
	<ul class="unstyled">
	<?php foreach($items as $key=>$item):?>
		<li class="span4 grid">
			<div class="hitem">
				<?php 
				if(empty($item['Item']['image_path'])){
					echo $this->Html->image('no-image.gif', array('width'=>'150', 'height'=>'150'));
				} else {
					echo $this->Html->image('items'.DS.$item['Item']['image_path'], array('width'=>'150', 'height'=>'150'));
				}			
				?>
				<br>
				<span class='title-item'>
					<?php echo $item['Item']['name']?>
				</span>
				<span class="title-item">
					<?php
					if(in_array($item['Item']['id'], $cart_items)) { 
						echo '<a href="#"><i class="icon-ok"></i></a>';
					}else {
						echo $this->Form->postLink('Adicionar ao carrinho', array('controller'=>'cart_items', 'action'=>'add', $item['Item']['id']), array('class'=>'btn btn-primary'));
					}
					?>
				</span>
			</div>
			
		</li>	
		<?php endforeach;?>
	</ul>	
	<?php 
	echo $this->element('pagination');
	}
	?>
</div>
