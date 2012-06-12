<div class="healthDistricts view">
<h2><?php  echo __('Health District');?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($healthDistrict['HealthDistrict']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($healthDistrict['HealthDistrict']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Criado'); ?></dt>
		<dd>
			<?php echo h($healthDistrict['HealthDistrict']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($healthDistrict['HealthDistrict']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar distrito sanitário'), array('action' => 'edit', $healthDistrict['HealthDistrict']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Deletar distrito sanitário'), array('action' => 'delete', $healthDistrict['HealthDistrict']['id']), null, __('Deseja realmente deletar o distrito sanitário #%s?', $healthDistrict['HealthDistrict']['name'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listar distritos sanitários'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo distrito sanitário'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar unidades'), array('controller' => 'unities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova unidade'), array('controller' => 'unities', 'action' => 'add')); ?> </li>
	</ul>
</div>
