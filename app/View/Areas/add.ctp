<div class="span2">	
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Áreas'), array('action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('Cidades'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Regioẽs'), array('controller' => 'regions', 'action' => 'index')); ?> </li>
		</ul>
	</div>
</div>

<div class="span4">
<?php echo $this->Form->create('Area', array('class'=>'well'));?>
	<fieldset>
		<legend><?php echo __('Adicionar área'); ?></legend>
		<?php
		echo $this->Form->input('name', array('label'=>__('Nome')));
		?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>__('Cadastrar'), 'class'=>'btn btn-primary'));?>
</div>
