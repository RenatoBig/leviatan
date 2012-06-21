<script>
$(document).ready(function() {

	//validação de formulário
	$("#UserLoginForm").validate({ 
    	rules: { 			
			'data[User][username]':{
				required: true
			},
			'data[User][password]':{
				required: true
			}
		},
		messages: {
			'data[User][username]':{
				required: "Campo obrigatório"
			},
			'data[User][password]':{
				required: "Campo obrigatório"
			}
		}
	}); 
	
});
</script>
<div id="login">
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
	<?php echo $this->Form->end(__('Login'));?>
</div>



