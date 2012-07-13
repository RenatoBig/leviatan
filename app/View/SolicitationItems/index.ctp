<div class="span2 actions">
	<ul class="nav nav-list">
		<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
		<li><?php echo $this->Html->link(__('Carrinho'), array('controller' => 'solicitation_items', 'action' => 'cart'), array('class'=>'btn')); ?> </li>
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
	<ul class="unstyled grid">
	<?php foreach($items as $key=>$item):?>
		<li class="span4">
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
					<?php echo $this->Form->button(__('Adicionar ao carrinho'), array('label'=>'', 'id'=>'button_'.$key, 'type'=>'button', 'value'=>$item['Item']['id'].'-'.$key, 'class'=>'addToCart btn btn-primary'));?>
				</span>
			</div>
			
		</li>	
		<?php endforeach;?>
	</ul>	
</div>
<?php 
echo $this->element('pagination');
}
?>	

