<div class="span9 well">
	<div class="row-fluid">
		<div class="span4 well">
			<?php 
			echo $this->Form->postLink(
				'GERENCIAMENTO DE USUÁRIOS',
				array('controller'=>'manager', 'action'=>'module_persons')		
			);
			?>
		</div>
		<div class="span4 well">
			<?php 
			echo $this->Form->postLink(
				'GERENCIAMENTO DE UNIDADES',
				array('controller'=>'manager', 'action'=>',module_unities')		
			);
			?>
		</div>
		<div class="span4 well">
			<?php 
			echo $this->Form->postLink(
				'GERENCIAMENTO DE ITENS',
				array('controller'=>'manager', 'action'=>'items')		
			);
			?>
		</div>
	</div>
</div>
