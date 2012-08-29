<div class="span9 well">
	<h2><?php echo __('Grupo de gastos');?></h2>
	<br>
	<dl class="dl-horizontal">
		<dt>Nome </dt>
		<dd><?php echo $expenseGroup['ExpenseGroup']['name']?></dd>
		<dt>Descrição: </dt>
		<dd>		
			<textarea disabled="disabled" id="ExpenseGroupDescription" rows="" cols=""><?php echo h($expenseGroup['ExpenseGroup']['description']); ?></textarea>
			<?php echo $this->Fck->load('ExpenseGroupDescription', 'None');?>	
		</dd>
	</dl>	
	
</div>
