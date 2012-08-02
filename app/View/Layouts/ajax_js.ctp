<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<?php echo $this->Html->charset(); ?>
		<?php
			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');			
	
			echo $this->Html->css(array('jquery-ui-1.8.21.custom', 'bootstrap', 'bootstrap-responsive', 'leviatan'));
			
			echo $this->Html->script(array('jquery-1.7.2', 'jquery-ui-1.8.21.custom.min', 
							'jquery.validate', 'bootstrap', 'bootstrap.min', 
							'bootstrap-tab', 'functions'
						)
					);
		?>
		
		<!-- <script type="text/javascript">
		   $("#flashMessage, #alert-message").fadeIn();		   
		   window.setTimeout(escondeMsg, 2500);   
		   
		   function escondeMsg() {   		
			$("#flashMessage, #alert-message").fadeOut();
		   }	
		</script>  -->
		
	</head>
	<body>						
		<div class="container">
			<div id="alert-message">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->Session->flash('auth'); ?>
			</div>	
			<div class="row-fluid">	
				<?php echo $this->fetch('content'); ?>
			</div>
			<?php echo $this->Html->image('indicator.gif', array('id' => 'busy-indicator')); ?>
			<div id="page-heaer">
			</div>
		</div>
		<?php echo $this->element('sql_dump'); ?>
		<?php if(class_exists('JsHelper') && method_exists($this->Js, 'writeBuffer')) echo $this->Js->writeBuffer(); ?>
		<!-- <div class="footer">
			<div class="imgFooter">
				<div class="textFooter">Footer</div>
			</div>
		</div>  -->
	</body>
</html>
