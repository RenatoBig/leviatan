<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<?php echo $this->Html->charset(); ?>
		<link type="text/css" rel="stylesheet" href="css/print.css">		
	</head>
	<body>	
		<div class="container">				
			<div class="row">  	
				<?php echo $this->fetch('content'); ?>
			</div> 
			<div id="page-heaer">
			</div>
		</div>
	</body>
</html>
