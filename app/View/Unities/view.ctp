<div class="span9 well">
	<h2><?php  echo __('Unidade');?></h2>
	<dl class="dl-horizontal">
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
