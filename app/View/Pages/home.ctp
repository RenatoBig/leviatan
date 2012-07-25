<div class="span2 actions">
	<ul class="nav nav-list">
		<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
		<li><?php echo $this->Html->link(__('Itens pendentes'), array('controller'=>'solicitation_items', 'action' => 'items', PENDENTE), array('class'=>'btn')); ?></li>
		<li><?php echo $this->Html->link(__('Solicitação'), array('controller'=>'solicitation_items', 'action' => 'index'), array('class'=>'btn')); ?></li>
	</ul>
</div>