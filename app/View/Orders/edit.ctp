<script>
$(document).ready(function() {

	$(function(){
		$(".calendario").datepicker({
		dateFormat: 'dd/mm/yy',
		dayNames: [
			'Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'
		],
		dayNamesMin: [
			'D','S','T','Q','Q','S','S','D'
		],
		dayNamesShort: [
			'Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'
		],
		monthNames: [
			'Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro',
			'Outubro','Novembro','Dezembro'
		],
		monthNamesShort: [
			'Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set',
			'Out','Nov','Dez'
		],
		nextText: 'Próximo',
		prevText: 'Anterior'

		});
	});

	//validação de formulário
	$("#OrderEditForm").validate({ 
    	rules: { 
			'data[Order][keycode]':{
				required: true,
			},
			'data[Order][user_id]':{
				required: true
			},
			'data[Order][start_date]':{
				required: true
			},
			'data[Order][end_date]':{
				required: true
			},
			'data[Order][status_id]':{
				required: true
			}
		},
		messages: {
			'data[Order][keycode]':{
				required: "Este campo é obrigatório.",
			},
			'data[Order][user_id]':{
				required: "Este campo é obrigatório."
			},
			'data[Order][start_date]':{
				required: "Este campo é obrigatório."
			},
			'data[Order][end_date]':{
				required: "Este campo é obrigatório."
			},
			'data[Order][status_id]':{
				required: "Este campo é obrigatório."
			}
		}
	}); 
	
});
</script>

<div class="orders form">
<?php echo $this->Form->create('Order');?>
	<fieldset>
		<legend><?php echo __('Editar Order'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('keycode', array('label'=>__('Código')));
		echo $this->Form->input('user_id', array('label'=>__('Usuário')));
		echo $this->Form->input('start_date', array('label'=>__('Data inicial'), 'class'=>'calendario', 'type'=>'text'));
		echo $this->Form->input('end_date', array('label'=>__('Data final'),'class'=>'calendario', 'type'=>'text'));
		echo $this->Form->input('status_id', array('label'=>__('Status')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Alterar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $this->Form->value('Order.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Order.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Orders'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo usuário'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar status'), array('controller' => 'statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo status'), array('controller' => 'statuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Items'), array('controller' => 'order_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Item'), array('controller' => 'order_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
