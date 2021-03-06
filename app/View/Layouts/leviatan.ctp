<?php
$leviatanDescription = __d('leviatan_dev', 'Leviatan');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<base href="<?php echo $this->Html->url('/', true);?>" />
		
		<?php echo $this->Html->charset(); ?>
		<title>
			<?php echo $leviatanDescription ?>:
			<?php echo $title_for_layout; ?>
		</title>
		<?php
			echo $this->fetch('meta');
			echo $this->fetch('script');
			echo $this->fetch('css');
			
			echo $this->Html->meta('icon');
	
			//css jquery
			echo $this->Html->css(array(
					'jquery-ui-1.8.23.custom', 'jquery.ui.autocomplete', 'jquery.ui.datepicker',
					'jquery.ui.core' 
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
					'validate', 'functions', 'ckeditor/ckeditor'
				)
			);
		?>
		
		<script type="text/javascript">
		   $("#flashMessage, #alert-message").fadeIn();		   
		   window.setTimeout(escondeMsg, 2500);		   	
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
							<?php 
							if($countSolicitations!= 0) {
							?>
							<li class="active">
								<?php								
								echo $this->Html->link(
									'<i class="icon-white icon-exclamation-sign"></i>',
									array('controller'=>'solicitations', 'action'=>'all'),
									array(
										'escape'=>false,
										'title'=>'Você possui solicitações pendentes',
										'alt'=>'pendencia'
									)		
								)
								?>
							</li>
							<?php 
							}	
							if($countCartItems != 0) {
							?>
							<li class="active">
								<?php								
								echo $this->Html->link(
									'<i class="icon-white icon-shopping-cart"></i>',
									array('controller'=>'cart_items', 'action'=>'index'),
									array(
										'escape'=>false,
										'title'=>'Você possui Itens no carrinho',
										'alt'=>'pendencia',
									)		
								)
								?>
							</li>
							<?php 
							}
							?>											
							<li class="dropdown">
								<?php echo $this->Html->link(
									'<i class="icon-user icon-white"></i>'.
									$user['Employee']['name'].
									'<b class="caret"></b>', 
									"#", 
									array('class'=>'dropdown-toggle', 'data-toggle'=>'dropdown', 'escape'=>false));
								?>							
								<ul class="dropdown-menu">
									<li>
										<?php echo $this->Html->link('Meu perfil', array('controller'=>'users', 'action'=>'profile', $user['User']['id']));?>
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
				
		<div class="container-fluid">
			<div id="alert-message">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->Session->flash('auth'); ?>
			</div>	
			<div class="row-fluid wrapper">  
				<?php echo $this->element('menu'); ?>					
				<?php echo $this->fetch('content'); ?>							
			</div> 
			<div id="page-heaer">
			</div>
		</div>
		<!-- <div class="footer">
			<div class="imgFooter">
				<div class="textFooter">Footer</div>
			</div>
		</div>  -->
		<?php echo $this->element('sql_dump'); ?>
		<?php if(class_exists('JsHelper') && method_exists($this->Js, 'writeBuffer')) echo $this->Js->writeBuffer(); ?>
	</body>
</html>
