<div class="functionalUnits view">
<h2><?php  echo __('Unidade funcional');?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($functionalUnit['FunctionalUnit']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($functionalUnit['FunctionalUnit']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Descrição'); ?></dt>
		<dd>
			<?php echo h($functionalUnit['FunctionalUnit']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Criado'); ?></dt>
		<dd>
			<?php echo h($functionalUnit['FunctionalUnit']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($functionalUnit['FunctionalUnit']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar unidade funcional'), array('action' => 'edit', $functionalUnit['FunctionalUnit']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Deletar unidade funcional'), array('action' => 'delete', $functionalUnit['FunctionalUnit']['id']), null, __('Deseja realmente deletar a unidade funcional #%s?', $functionalUnit['FunctionalUnit']['name'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listar unidades funcionais'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova unidade funcional'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar PNGC'), array('controller' => 'pngc_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo PNGC'), array('controller' => 'pngc_codes', 'action' => 'add')); ?> </li>
	</ul>
</div>
