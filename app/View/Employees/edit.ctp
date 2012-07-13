<div class="span2 actions">	
	<ul class="nav nav-list">
		<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
		<li><?php echo $this->Html->link(__('Funcionários'), array('action' => 'index'), array('class'=>'btn')); ?></li>
		<li><?php echo $this->Html->link(__('Usuários'), array('controller' => 'users', 'action' => 'index'), array('class'=>'btn')); ?> </li>
		<li><?php echo $this->Html->link(__('Unidades setores'), array('controller' => 'unity_sectors', 'action' => 'index'), array('class'=>'btn')); ?> </li>
	</ul>
</div>

<div class="span4 form">
<?php echo $this->Form->create('Employee', array('class'=>'well'));?>
	<fieldset>
		<legend><?php echo __('Editar funcionário'); ?></legend>
	<?php
		//requisição feita quando se muda a unidade. Como resposta ele popula o select
		//dos setores de acordo com a unidade escolhida 
		//-------------------
		$this->Js->get('#unity_id')->event('change', 
			$this->Js->request(
				array(
					'controller'=>'UnitySectors',
					'action'=>'getSector'
				), 
				array(
					'update'=>'#sector',
					'async' => true,
					'method' => 'post',
					'dataExpression'=>true,
					'data'=> $this->Js->serializeForm(
						array(
							'isForm' => true,
							'inline' => true
						)
					)
				)
			)
		);		
		//----------------------
		echo $this->Form->input('id', array('type' => 'hidden'));
		echo $this->Form->input('registration', array('label'=>__('Matrícula')));
		echo $this->Form->input('Unity', array('label'=>__('Unidades'), 'id'=>'unity_id', 'value'=>$this->request->data['UnitySector']['unity_id']));
		echo $this->Form->input('unity_sector_id', array('label'=>__('Setor'),'id'=>'sector','options'=>$sectors, 'value'=>$this->request->data['UnitySector']['id']));
		echo $this->Form->input('name', array('label'=>__('Nome')));
		echo $this->Form->input('surname', array('label'=>__('Sobrenome')));
		echo $this->Form->input('birth_date', array('label'=>__('Data de Nascimento'), 'class'=>'calendario input-small', 'type'=>'text'));
		echo $this->Form->input('email', array('label'=>__('Email')));
		echo $this->Form->input('phone', array('label'=>__('Telefone')));
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
<?php echo $this->Form->end(array('label'=>__('Alterar'), 'class'=>'btn btn-primary'));?>
</div>
