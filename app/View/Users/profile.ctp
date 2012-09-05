<div class="span9 well">
	<?php echo $this->Form->create('Profile', array('class'=>'form-horizontal'));?>
		<?php echo $this->Form->input('user_id', array('type'=>'hidden', 'value'=>$user['User']['id']));?>
		<?php echo $this->Form->input('employee_id', array('type'=>'hidden', 'value'=>$user['User']['employee_id']));?>
		<fieldset>
			<legend><?php echo __('Meu perfil'); ?></legend>
			<div class="form-inline">
				<div class="control-group">
					<label class="control-label" for="ProfileRegistration">Matrícula</label>
					<div class="controls">
						<?php echo $this->Form->input('registration', array('label'=>false, 'disabled'=>true, 'value'=>$user['Employee']['registration'], 'class'=>'input-mini', 'div'=>false));?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="ProfileName">Nome</label>
					<div class="controls">
						<?php echo $this->Form->input('name', array('label'=>false, 'disabled'=>true, 'value'=>$user['Employee']['name'].' '.$user['Employee']['surname'], 'div'=>false));?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="ProfileBirthDate">Data de Nascimento</label>
					<div class="controls">
						<?php echo $this->Form->input('birth_date', array('label'=>false, 'value'=>$this->Time->format('d/m/Y', $user['Employee']['birth_date']), 'class'=>'calendario input-small mask-date'));?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="ProfilePhone">Telefone</label>
					<div class="controls">
						<?php echo $this->Form->input('phone', array('label'=>false, 'value'=>$user['Employee']['phone'], 'class'=>'input-small mask-phone'));?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="ProfileEmail">Email</label>
					<div class="controls">
						<?php echo $this->Form->input('email', array('label'=>false, 'value'=>$user['Employee']['email']));?>
					</div>
				</div>
				<hr class="bs-docs-separator">
				<div class="control-group">
					<label class="control-label" for="ProfilePassword">Senha</label>
					<div class="controls">
						<?php echo $this->Form->input('password', array('label'=>false, 'value'=>'', 'type'=>'password'));?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="ProfileConfirmPassword">Confirmar Senha</label>
					<div class="controls">
						<?php echo $this->Form->input('confirm_password', array('label'=>false, 'value'=>'', 'type'=>'password'));?>
					</div>
				</div>
				
				<hr class="bs-docs-separator">
			</div>
		</fieldset>
		
		<div class="control-group">
			<div class="controls">
				<?php echo $this->Form->button(__('Alterar'), array('class'=>'btn btn-primary', 'title'=>__('Cadastrar usuário')));?>
				<?php echo $this->Html->link(__('Cancelar'), array('controller'=>'pages', 'action'=>'home'), array('title'=>__('Cancelar'), 'class'=>'btn'))?>
			</div>
		</div>		
	<?php echo $this->Form->end();?>
</div>
