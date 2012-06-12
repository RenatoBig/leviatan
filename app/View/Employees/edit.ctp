<script>
$(document).ready(function() {

	//Combo box
	$('#unity_id').change(function() {
		if($(this).val() == 0) {
			$('#sector').parent().hide('slow');
		}else {
			$('#sector').parent().show('slow');
		}
	});	

	//validação de formulário
	$("#EmployeeEditForm").validate({ 
    	rules: { 
			'data[Employee][registration]':{
				required: true,
				number: true,
				minlength: 6
			},
			'data[Employee][Unity]':{
				required: true
			},
			'data[Employee][unity_sector_id]':{
				required: true
			},
			'data[Employee][name]':{
				required: true,
				minlength: 3
			}
		},
		messages: {
			'data[Employee][registration]':{
				required: "Este campo é obrigatório",
				minlength: "Quantidade mínima de dígitos é 6",
				number: "Apenas números são permitidos"					
			},
			'data[Employee][Unity]':{
				required: "Selecione uma unidade"
			},
			'data[Employee][unity_sector_id]':{
				required: "Selecione um setor"
			},
			'data[Employee][name]':{
				required: "Este campo é obrigatório.",
				minlength: "Nome muito pequeno"
			}
		}
	}); 
	
});
</script>

<div class="employees form">
<?php echo $this->Form->create('Employee');?>
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
		echo $this->Form->input('birth_date', array('label'=>__('Data de Nascimento')));
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
<?php echo $this->Form->end(__('Editar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Deletar funcionário'), array('action' => 'delete', $this->Form->value('Employee.id')), null, __('Você tem certeza que quer deletar o funcionário # %s?', $this->Form->value('Employee.name'))); ?></li>
		<li><?php echo $this->Html->link(__('List Employees'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Unity Sectors'), array('controller' => 'unity_sectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unity Sector'), array('controller' => 'unity_sectors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>