<div class="cities view">
<h2><?php  echo __('Cidade');?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($city['City']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Código'); ?></dt>
		<dd>
			<?php echo h($city['City']['keycode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($city['City']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Criado'); ?></dt>
		<dd>
			<?php echo h($city['City']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($city['City']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar cidade'), array('action' => 'edit', $city['City']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Deletar cidade'), array('action' => 'delete', $city['City']['id']), null, __('Deseja realmente deletar #%s?', $city['City']['name'])); ?> </li>
		<li><?php echo $this->Html->link(__('Lista de cidades'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova cidade'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Lista de regiões'), array('controller' => 'regions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova região'), array('controller' => 'regions', 'action' => 'add')); ?> </li>
	</ul>
</div>