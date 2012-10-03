<div class="span9 well">
<?php echo $this->Form->create('Unity');?>
	<fieldset>
		<legend><?php echo __('Editar unidade'); ?></legend>
	<?php
		echo $this->Form->input('cnes', array('label'=>__('CNES')));
		echo $this->Form->input('cnpj', array('label'=>__('CNPJ')));
		echo $this->Form->input('name', array('label'=>__('Nome')));
		echo $this->Form->input('trade_name', array('label'=>__('Nome fantasia')));
		echo $this->Form->input('cep', array('label'=>__('CEP'), 'id'=>'input-cep', 'class'=>'input-small', 'maxlength'=>'8', 'value'=>$this->request->data['Address']['postal_code']));
		echo $this->Form->button('pesquisar', array('type'=>'button', 'id'=>'search-cep'));
		
		echo $this->Form->input('cod_response', array('type'=>'hidden'));
		echo $this->Form->input('state_hidden', array('type'=>'hidden', 'value'=>$this->request->data['State']['id']));
		echo $this->Form->input('address_hidden', array('type'=>'hidden', 'value'=>$this->request->data['Address']['id']));
		echo $this->Form->input('state', array('label'=>'Estado', 'disabled'=>'disabled', 'options'=>$states, 'value'=>$this->request->data['State']['uf']));
		echo $this->Form->input('city', array('label'=>'Cidade','readonly'=>true, 'value'=>$this->request->data['City']['name']));
		echo $this->Form->input('district', array('label'=>'Bairro','readonly'=>true, 'value'=>$this->request->data['District']['name']));
		echo $this->Form->input('address', array('label'=>'Endereço','readonly'=>true, 'class'=>'input-xlarge', 'value'=>$this->request->data['Address']['name']));
		
		echo $this->Form->input('number', array('label'=>__('Número'), 'class'=>'input-mini'));
		echo $this->Form->input('phone', array('label'=>__('Telefone')));
		echo $this->Form->input('fax', array('label'=>__('FAX')));
		echo $this->Form->input('health_district_id', array('label'=>__('Distrito sanitário'), 'options'=>$health_districts));
		echo $this->Form->input('unity_type_id', array('label'=>__('Tipo da unidade'), 'options'=>$unity_types));
	?>
	</fieldset>
	<?php echo $this->Form->button(__('Alterar'), array('class'=>'btn btn-primary', 'title'=>__('Alterar unidade')));?>
	<?php echo $this->Html->link(__('Cancelar'), array('controller'=>'unities', 'action'=>'index'), array('class'=>'btn', 'title'=>__('Cancelar')));?>
<?php echo $this->Form->end();?>
</div>
