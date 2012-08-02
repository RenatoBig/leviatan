<div class="span3 actions well">
	<ul class="nav nav-list">
		<li class="nav-header"><h3 align="center"><?php echo __('Menu'); ?></h3></li>
		<li class="divider"></li>
		<?php foreach($menus as $menu): ?>
			<li><?php echo $this->Html->link($menu['name'], $menu['link'], array('class'=>'btn'));?></li>
		<?php endforeach;?>
	</ul>
</div>