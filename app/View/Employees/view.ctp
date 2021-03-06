<div class="span9 well">
	<h2><?php  echo __('Funcionário');?></h2>
	<dl>
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
			<?php echo h($employee['Employee']['name'].' '.$employee['Employee']['surname']); ?>
			&nbsp;
		</dd>		
		<dt><?php echo __('Nascimento'); ?></dt>
		<dd>
			<?php echo $this->Time->format('d/m/Y', $employee['Employee']['birth_date']); ?>
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
		<dt><?php echo __('Unidade-Setor'); ?></dt>
		<dd>
			<?php 
			echo $this->Form->postLink($unity['Unity']['name'], array('controller'=>'unities', 'action'=>'view', $unity['Unity']['id'])).
					   ' - '.
			           $sector['Sector']['name']; 
			?>
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
