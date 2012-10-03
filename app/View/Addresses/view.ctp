<div class="span9 well">
	<h2><?php  echo __('Endereço');?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('CEP'); ?></dt>
		<dd>
			<?php echo h($address['Address']['postal_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($address['Address']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bairro'); ?></dt>
		<dd>
			<?php echo h($address['District']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cidade'); ?></dt>
		<dd>
			<?php echo h($address['City']['name'].' - '.$address['State']['uf']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
