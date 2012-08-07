<?php
$leviatanDescription = __d('leviatan_dev', 'Leviatan');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<?php echo $this->Html->charset(); ?>
		<?php
			echo $this->fetch('css');
	
			echo $this->Html->css(array('autocomplete', 'jquery-ui-1.8.21.custom', 'bootstrap', 'bootstrap-responsive', 'leviatan'));	
		?>		
	</head>
	<body>				
		<div class="container-fluid">				
			<div class="row-fluid wrapper">  	
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
		<?php // echo $this->element('sql_dump'); ?>
		<?php //if(class_exists('JsHelper') && method_exists($this->Js, 'writeBuffer')) echo $this->Js->writeBuffer(); ?>
	</body>
</html>
