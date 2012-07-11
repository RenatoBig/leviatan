<?php
$leviatanDescription = __d('leviatan_dev', 'Leviatan');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>
			<?php echo $leviatanDescription ?>:
			<?php echo $title_for_layout; ?>
		</title>
		<?php
			echo $this->Html->meta('icon');
	
			echo $this->Html->css(array('jquery-ui-1.8.21.custom', 'bootstrap', 'bootstrap.min', 'bootstrap-responsive', 'bootstrap-responsive.min'));
	
			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
			
			echo $this->Html->script(array('jquery-1.7.2', 'jquery-ui-1.8.21.custom.min', 'jquery.validate', 'bootstrap', 'bootstrap.min', 'autocomplete', 'validate', 'bootstrap-modal'));
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
		<div class="container">				
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Session->flash('auth'); ?>		
			<div class="row">	
				<?php echo $this->fetch('content'); ?>
			</div>
			<div id="page-heaer">
			</div>
		</div>
		<?php echo $this->element('sql_dump'); ?>
		<?php if(class_exists('JsHelper') && method_exists($this->Js, 'writeBuffer')) echo $this->Js->writeBuffer(); ?>
		
	</body>
</html>
