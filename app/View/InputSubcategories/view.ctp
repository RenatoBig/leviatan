<div class="inputSubcategories view">
<h2><?php  echo __('Subcategoria de insumo');?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($inputSubcategory['InputSubcategory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($inputSubcategory['InputSubcategory']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Descrição'); ?></dt>
		<dd>
			<?php echo h($inputSubcategory['InputSubcategory']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Criado'); ?></dt>
		<dd>
			<?php echo h($inputSubcategory['InputSubcategory']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($inputSubcategory['InputSubcategory']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar subcategoria'), array('action' => 'edit', $inputSubcategory['InputSubcategory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Deletar subcategoria'), array('action' => 'delete', $inputSubcategory['InputSubcategory']['id']), null, __('Deseja realmente deletar a subcategoria #%s?', $inputSubcategory['InputSubcategory']['name'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listar subcategorias'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova subcategoria'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar insumos'), array('controller' => 'inputs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo insumo'), array('controller' => 'inputs', 'action' => 'add')); ?> </li>
	</ul>
</div>
