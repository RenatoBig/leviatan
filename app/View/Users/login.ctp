<div class="span4 offset4">
	<?php echo $this->Form->create('User', array('action'=>'login', 'class'=>'well'));?>
		<fieldset>
			<legend><?php echo __('Login'); ?></legend>
		<?php
			echo "<div class='required'>";
				echo $this->Form->input('username', array('label'=>'Login'));
			echo "</div>";	
			echo $this->Form->input('password', array('label'=>'Senha'));	
		?>
		</fieldset>
	<?php echo $this->Form->end(array('label'=>__('Login'), 'class'=>'btn btn-primary'));?>
</div>



