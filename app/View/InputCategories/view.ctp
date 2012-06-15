<div class="inputCategories view">
<h2><?php  echo __('Categoria de insumo');?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($inputCategory['InputCategory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($inputCategory['InputCategory']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Descrição'); ?></dt>
		<dd>
			<?php echo h($inputCategory['InputCategory']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Criado'); ?></dt>
		<dd>
			<?php echo h($inputCategory['InputCategory']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($inputCategory['InputCategory']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar categoria de insumo'), array('action' => 'edit', $inputCategory['InputCategory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Deletar categoria de insumo'), array('action' => 'delete', $inputCategory['InputCategory']['id']), null, __('Deseja realmente deletar a categoria de insumo #%s?', $inputCategory['InputCategory']['name'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listar categorias de insumos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova categoria de insumo'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar insumos'), array('controller' => 'inputs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo insumo'), array('controller' => 'inputs', 'action' => 'add')); ?> </li>
	</ul>
</div>
