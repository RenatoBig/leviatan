<div class="span2">	
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Funcionários'), array('action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('Usuários'), array('controller' => 'users', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Unidades setores'), array('controller' => 'unity_sectors', 'action' => 'index')); ?> </li>
		</ul>
	</div>
</div>

<div class="span4 well">
	<h2><?php  echo __('Funcionário');?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Matrícula'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['registration']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Data de aniversário'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['birth_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telefone'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('RG'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['rg']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CPF'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['cpf']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Título eleitoral'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['voter_card']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cateira de traballho'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['ctps']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Reservista'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['reservist']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Agência'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['agency']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Conta'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['account']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unidade_Setor'); ?></dt>
		<dd>
			<?php echo $this->Html->link($employee['UnitySector']['id'], array('controller' => 'unity_sectors', 'action' => 'view', $employee['UnitySector']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Criado'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
