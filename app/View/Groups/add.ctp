<div class="span2">
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Grupos'), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('Usuários'), array('controller' => 'users', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Novo usuário'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="span4">
	<?php echo $this->Form->create('Group', array('class'=>'well'));?>
		<fieldset>
			<legend><?php echo __('Adicionar grupo'); ?></legend>
			<div class="control-group">
				<?php
				echo $this->Form->input('name', array('label'=>__('Nome'), 'class'=>'control-label'));
				?>
			</div>
		</fieldset>
	<?php echo $this->Form->end(array('label'=>__('Cadastrar'), 'class'=>'btn btn-primary'));?>
</div>
