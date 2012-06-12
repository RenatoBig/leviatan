<div class="unityTypes view">
<h2><?php  echo __('Tipo da unidade');?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($unityType['UnityType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($unityType['UnityType']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Criado'); ?></dt>
		<dd>
			<?php echo h($unityType['UnityType']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($unityType['UnityType']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar tipo da unidade'), array('action' => 'edit', $unityType['UnityType']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Deletar tipo da unidade'), array('action' => 'delete', $unityType['UnityType']['id']), null, __('Are you sure you want to delete # %s?', $unityType['UnityType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listar tipos das unidades'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo tipo de unidade'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar unidades'), array('controller' => 'unities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova unidade'), array('controller' => 'unities', 'action' => 'add')); ?> </li>
	</ul>
</div>