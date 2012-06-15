<div class="inputs view">
<h2><?php  echo __('Insumo');?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($input['Input']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Categoria'); ?></dt>
		<dd>
			<?php echo $this->Html->link($input['InputCategory']['name'], array('controller' => 'input_categories', 'action' => 'view', $input['InputCategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Subcategoria'); ?></dt>
		<dd>
			<?php echo $this->Html->link($input['InputSubcategory']['name'], array('controller' => 'input_subcategories', 'action' => 'view', $input['InputSubcategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Criado'); ?></dt>
		<dd>
			<?php echo h($input['Input']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($input['Input']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar insumo'), array('action' => 'edit', $input['Input']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Deletar insumo'), array('action' => 'delete', $input['Input']['id']), null, __('Are you sure you want to delete # %s?', $input['Input']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listar insumos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo insumo'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar categorias'), array('controller' => 'input_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova categoria'), array('controller' => 'input_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar subcategorias'), array('controller' => 'input_subcategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova subcategoria'), array('controller' => 'input_subcategories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar PNGCs'), array('controller' => 'pngc_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo PNGC'), array('controller' => 'pngc_codes', 'action' => 'add')); ?> </li>
	</ul>
</div>
