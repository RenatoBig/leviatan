<div class="span9">
	<div class="row-fluid">
		<?php foreach($modules as $module):?>
		<div class="row-fluid">
			<div class="span12 well">		
				<?php for($i = 0; $i < ceil(count($module) / 4); $i++){?>
					<div class="row-fluid">
						<?php for($j = $i; $j < 4*($i+1); $j++) {?>
							<div class="span3 well"><i class="icon-glass"></i></div>
						<?php }?>
					</div>
				<?php }?>
			</div>
		</div>
		<?php endforeach;?>	
	</div>
</div>
	
