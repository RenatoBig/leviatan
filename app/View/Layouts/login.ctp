<?php
$leviatanDescription = __d('leviatan_dev', 'Leviatan');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<base href="<?php echo $this->Html->url('/', true);?>" />
		
		<?php echo $this->Html->charset(); ?>
		<title>
			<?php echo $leviatanDescription ?>:
			<?php echo $title_for_layout; ?>
		</title>
		<?php
			echo $this->Html->meta('icon');
	
			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
			
				//css jquery
			echo $this->Html->css(array(
					'jquery-ui-1.8.23.custom'
				)
			);
			//css bootstrap
			echo $this->Html->css(array('bootstrap', 'bootstrap-responsive'));
			//Outros css
			echo $this->Html->css(array('leviatan'));
			
			//JS jquery
			echo $this->Html->script(array(
					'jquery-1.8.0.min', 'jquery-ui-1.8.23.custom.min','jquery.ui.autocomplete.min', 
					'jquery.ui.core.min', 'jquery.ui.datepicker.min', 'jquery.ui.position.min', 
					'jquery.ui.widget.min', 'jquery.validate', 'jquery.maskedinput-1.3.min'		
				)
			);
			//JS bootstrap
			echo $this->Html->script(array( 
					'bootstrap', 'bootstrap.min', 'bootstrap-modal', 
					'bootstrap-tab', 'bootstrap-dropdown'							 
				)
			);
			//Outros JS
			echo $this->Html->script(array(
					'functions', 'ckeditor/ckeditor'
				)
			);
			?>	
		 <script type="text/javascript">
	   	 	$("#flashMessage, #authMessage").fadeIn();
	   
		    window.setTimeout(escondeMsg, 3500);   
		    function escondeMsg() {   		
			    $("#flashMessage, #authMessage").fadeOut();
		    }	
		</script>	
	</head>
	<body>
			<!-- nav-bar -->
		<div class="navbar">
			<div class="navbar-inner">
		    	<div class="container">
		    		<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
		    		<?php echo $this->Html->link('Leviatan', array('controller'=>'pages', 'action'=>'home'), array('class'=>'brand'));?>
					<div class="nav-collapse">
						<ul class="nav pull-right">							
							<li>
								<?php echo $this->Form->create('User', array('url'=>'/users/login','class'=>'form-horizontal'));?>
									<?php echo $this->Form->input('username', array('label'=>false, 'class'=>'input-small', 'div'=>false))?>
									<?php echo $this->Form->input('password', array('label'=>false, 'class'=>'input-small', 'div'=>false))?>
									<?php echo $this->Form->Button('Entrar', array('class'=>'btn'));?>									
								<?php echo $this->Form->end();?>
							</li>
						</ul>
					<!-- nav-collapse -->
					</div>
				<!-- /container -->
		    	</div>
			<!-- /navbar-inner -->
			</div>
		<!-- /navbar -->
		</div>
		<div class="container-fluid">				
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Session->flash('auth'); ?>		
			<div class="row-fluid wrapper">	
				<?php echo $this->fetch('content'); ?>
			</div>
			<div id="page-heaer">
			</div>
		</div>
		<?php echo $this->element('sql_dump'); ?>
		<?php if(class_exists('JsHelper') && method_exists($this->Js, 'writeBuffer')) echo $this->Js->writeBuffer(); ?>
		
	</body>
</html>