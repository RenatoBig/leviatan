<div class="unities view">
<h2><?php  echo __('Unidade');?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($unity['Unity']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CNES'); ?></dt>
		<dd>
			<?php echo h($unity['Unity']['cnes']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CNPJ'); ?></dt>
		<dd>
			<?php echo h($unity['Unity']['cnpj']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($unity['Unity']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome fantasia'); ?></dt>
		<dd>
			<?php echo h($unity['Unity']['trade_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Endereço'); ?></dt>
		<dd>
			<?php echo h($unity['Unity']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Número'); ?></dt>
		<dd>
			<?php echo h($unity['Unity']['number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CEP'); ?></dt>
		<dd>
			<?php echo h($unity['Unity']['cep']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telefone'); ?></dt>
		<dd>
			<?php echo h($unity['Unity']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('FAX'); ?></dt>
		<dd>
			<?php echo h($unity['Unity']['fax']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Região'); ?></dt>
		<dd>
			<?php echo $this->Html->link($unity['Region']['id'], array('controller' => 'regions', 'action' => 'view', $unity['Region']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Distrito sanitário'); ?></dt>
		<dd>
			<?php echo $this->Html->link($unity['HealthDistrict']['name'], array('controller' => 'health_districts', 'action' => 'view', $unity['HealthDistrict']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tipo da unidade'); ?></dt>
		<dd>
			<?php echo $this->Html->link($unity['UnityType']['name'], array('controller' => 'unity_types', 'action' => 'view', $unity['UnityType']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Criado'); ?></dt>
		<dd>
			<?php echo h($unity['Unity']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($unity['Unity']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar unidade'), array('action' => 'edit', $unity['Unity']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Deletar unidade'), array('action' => 'delete', $unity['Unity']['id']), null, __('Are you sure you want to delete # %s?', $unity['Unity']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listar unidades'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova unidade'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar regiões'), array('controller' => 'regions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova região'), array('controller' => 'regions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar distritos sanitários'), array('controller' => 'health_districts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo distrito sanitário'), array('controller' => 'health_districts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar tipos das unidades'), array('controller' => 'unity_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo tipo da unidade'), array('controller' => 'unity_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar unidades_setores'), array('controller' => 'unity_sectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo unidade_setor'), array('controller' => 'unity_sectors', 'action' => 'add')); ?> </li>
	</ul>
</div>
