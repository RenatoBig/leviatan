<?php
$leviatanDescription = __d('leviatan_dev', 'Leviatan');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>
			<?php echo $leviatanDescription ?>:
			<?php echo $title_for_layout; ?>
		</title>
		<?php
			echo $this->Html->meta('icon');
	
			echo $this->Html->css(array('autocomplete', 'jquery-ui-1.8.21.custom', 'bootstrap', 'bootstrap.min', 'bootstrap-responsive', 'bootstrap-responsive.min', 'leviatan'));
	
			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
			
			echo $this->Html->script(array('jquery-1.7.2', 'jquery-ui-1.8.21.custom.min', 'jquery.validate', 'bootstrap', 'bootstrap.min', 'bootstrap-modal', 'bootstrap-dropdown', 'autocomplete', 'validate', 'functions'));
		?>
		
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
							<li class="dropdown">
								<?php echo $this->Html->link(
									'<i class="icon-user"></i>'.
									$user['Employee']['name'].
									'<b class="caret"></b>', 
									"#", 
									array('class'=>'dropdown-toggle', 'data-toggle'=>'dropdown', 'escape'=>false));
								?>							
								<ul class="dropdown-menu">
									<li>
										<?php echo $this->Html->link('Meu perfil', array('controller'=>'users', 'action'=>'view', $user['User']['id']));?>
									</li>
									<li class="divider"></li>
									<li>
										<?php echo $this->Html->link('Logout', array('controller'=>'users', 'action'=>'logout'))?>
									</li>
								</ul>
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
				
		<div class="container">				
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Session->flash('auth'); ?>		
			<div class="row-fluid">	
				<?php echo $this->fetch('content'); ?>
			</div>
			<div id="page-heaer">
			</div>
		</div>
		<?php echo $this->element('sql_dump'); ?>
		<?php if(class_exists('JsHelper') && method_exists($this->Js, 'writeBuffer')) echo $this->Js->writeBuffer(); ?>
		
	</body>
</html>
