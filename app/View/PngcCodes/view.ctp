<div class="pngcCodes view">
<h2><?php  echo __('PNGC');?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($pngcCode['PngcCode']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Código'); ?></dt>
		<dd>
			<?php echo h($pngcCode['PngcCode']['keycode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Grupo de gastos'); ?></dt>
		<dd>
			<?php echo $this->Html->link($pngcCode['ExpenseGroup']['name'], array('controller' => 'expense_groups', 'action' => 'view', $pngcCode['ExpenseGroup']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unidade funcional'); ?></dt>
		<dd>
			<?php echo $this->Html->link($pngcCode['FunctionalUnit']['name'], array('controller' => 'functional_units', 'action' => 'view', $pngcCode['FunctionalUnit']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Insumo'); ?></dt>
		<dd>
			<?php echo $this->Html->link($pngcCode['Input']['id'], array('controller' => 'inputs', 'action' => 'view', $pngcCode['Input']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tipo de medida'); ?></dt>
		<dd>
			<?php echo $this->Html->link($pngcCode['MeasureType']['name'], array('controller' => 'measure_types', 'action' => 'view', $pngcCode['MeasureType']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Criado'); ?></dt>
		<dd>
			<?php echo h($pngcCode['PngcCode']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($pngcCode['PngcCode']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Ações/'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar PNGC'), array('action' => 'edit', $pngcCode['PngcCode']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Deletar PNGC'), array('action' => 'delete', $this->Form->value('PngcCode.id')), null, __('Deseja realmente deletar o PNGC #%s?', $this->Form->value('PngcCode.keycode'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar PNGCs'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar Grupos de gastos'), array('controller' => 'expense_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo grupo de gastos'), array('controller' => 'expense_groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar unidades funcionais'), array('controller' => 'functional_units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova unidade funcional'), array('controller' => 'functional_units', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar categorias de insumos'), array('controller' => 'input_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova categoria de insumo'), array('controller' => 'input_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar subcategorias de insumos'), array('controller' => 'input_subcategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova subcategoria de insumos '), array('controller' => 'input_subcategories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar tipos de medidas'), array('controller' => 'measure_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo tipo de medida'), array('controller' => 'measure_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar itens'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
