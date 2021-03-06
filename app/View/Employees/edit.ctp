<div class="span9 well">
<?php echo $this->Form->create('Employee');?>
	<fieldset>
		<legend><?php echo __('Editar funcionário'); ?></legend>
	<?php
		echo $this->Form->input('id', array('type' => 'hidden'));
		echo $this->Form->input('registration', array('label'=>__('Matrícula')));
		echo $this->Form->input('Unity', array('label'=>__('Unidade'), 'id'=>'select_parent', 'value'=>$this->request->data['UnitySector']['unity_id']));
		echo $this->Form->input('unity_sector_id', array('label'=>__('Setor'),'id'=>'select_child','options'=>$sectors, 'value'=>$this->request->data['UnitySector']['id']));
		echo $this->Form->input('name', array('label'=>__('Nome')));
		echo $this->Form->input('surname', array('label'=>__('Sobrenome')));
		echo $this->Form->input('birth_date', array('label'=>__('Data de Nascimento'), 'class'=>'calendario mask-date input-small', 'type'=>'text', 'value'=>$this->Time->format('d/m/Y', $this->request->data['Employee']['birth_date'])));
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
		<?php echo $this->Form->button(__('Alterar'), array('class'=>'btn btn-primary', 'title'=>__('Alterar funcionário')));?>
	<?php echo $this->Html->link(__('Cancelar'), array('controller'=>'employees', 'action'=>'index'), array('class'=>'btn', 'title'=>__('Cancelar')))?>
<?php echo $this->Form->end();?>
</div>
