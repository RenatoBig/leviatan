<div class="measureTypes view">
<h2><?php  echo __('Tipo de medida');?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($measureType['MeasureType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($measureType['MeasureType']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Descrição'); ?></dt>
		<dd>
			<?php echo h($measureType['MeasureType']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Criado'); ?></dt>
		<dd>
			<?php echo h($measureType['MeasureType']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($measureType['MeasureType']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar tipo de medida'), array('action' => 'edit', $measureType['MeasureType']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Deletar tipo de medida'), array('action' => 'delete', $measureType['MeasureType']['id']), null, __('Deseja realmente deletar o tipo de medida #%s?', $measureType['MeasureType']['name'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listar tipos de medidas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo tipo de medida'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar PNGCs'), array('controller' => 'pngc_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo PNGC'), array('controller' => 'pngc_codes', 'action' => 'add')); ?> </li>
	</ul>
</div>
