<div class="span9 well">
<?php echo $this->Form->create('Employee');?>
	<fieldset>
		<legend><?php echo __('Adicionar funcionário'); ?></legend>
	<?php
		echo $this->Form->input('Unity', array('label'=>__('Unidade'), 'onChange'=>'selectFill("unity_sectors", "get_sectors", options[selectedIndex].value)'));
		echo $this->Form->input('unity_sector_id', array('label'=>__('Setor'),'id'=>'select_child', 'options'=>$sectors));
		echo $this->Form->input('registration', array('label'=>__('Matrícula'), 'class'=>'span2'));
		
		echo '<div class="controls controls-row">';
			echo $this->Form->input('name', array('label'=>__('Nome')));
			echo $this->Form->input('surname', array('label'=>__('Sobrenome')));
		echo '</div>';
		
		echo $this->Form->input('birth_date', array('label'=>__('Data de Nascimento'), 'class'=>'calendario input-small mask-date', 'type'=>'text'));
		echo $this->Form->input('email', array('label'=>__('Email')));
		echo $this->Form->input('phone', array('label'=>__('Telefone'), 'class'=>'mask-phone'));
		echo $this->Form->input('rg', array('label'=>__('RG')));
		echo $this->Form->input('cpf', array('label'=>__('CPF')));
		echo $this->Form->input('voter_card', array('label'=>__('Título de eleitor')));
		echo $this->Form->input('ctps', array('label'=>__('Cateira de trabalho')));
		echo $this->Form->input('reservist', array('label'=>__('Reservista')));
		echo "<h2>Dados bancários</h2>";
		echo $this->Form->input('agency', array('label'=>__('Agência')));
		echo $this->Form->input('account', array('label'=>__('Conta corrente')));		
	?>
	</fieldset>
	<?php echo $this->Form->button(__('Cadastrar'), array('class'=>'btn btn-primary', 'title'=>__('cadastrar funcionário')));?>
	<?php echo $this->Html->link(__('Cancelar'), array('controller'=>'employees', 'action'=>'index'), array('class'=>'btn', 'title'=>__('Cancelar')))?>
<?php echo $this->Form->end();?>
</div>
