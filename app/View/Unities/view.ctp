<div class="span9 well">
	<h2><?php  echo __('Unidade');?></h2>
	<dl class="dl-horizontal">
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
		<dt><?php echo __('CEP'); ?></dt>
		<dd>
			<?php echo h($unity['Address']['postal_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Endereço'); ?></dt>
		<dd>
			<?php 
			echo ($this->Form->postLink($unity['Address']['name'], array('controller'=>'addresses', 'action'=>'view', $unity['Address']['id']))).					
				 ' - '.
				 ($unity['Unity']['number'] == '' ? 'S/N' : $unity['Unity']['number']); 
			?>
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
		<dt><?php echo __('Distrito sanitário'); ?></dt>
		<dd>
			<?php echo $unity['HealthDistrict']['name']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tipo da unidade'); ?></dt>
		<dd>
			<?php echo $unity['UnityType']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
