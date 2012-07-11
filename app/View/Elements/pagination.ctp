<ul class="paginacao">
	<li>
		<?php echo $this->Paginator->prev('« Anterior', null, null, array('class' => 'disabled')) ?>
	</li>
	<li>	
		<?php echo str_replace( '|', '</li><li>', $this->Paginator->numbers()) ?>
	</li>
	<li>
		<?php echo $this->Paginator->next(' Próximo »', null, null, array('class' => 'disabled')) ?>
	</li>
</ul>