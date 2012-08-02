<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Justificativa da negação</h3>
</div>
<div class="modal-body">
	<textarea disabled="disabled" id="JustificationDescription" rows="" cols=""><?php echo h($justification['Justification']['description']); ?></textarea>
	<?php echo $this->Fck->load('JustificationDescription', 'None');?>    		
</div>
<div class="modal-footer">
   	<a href="#" class="btn" data-dismiss="modal">Fechar</a>
</div>