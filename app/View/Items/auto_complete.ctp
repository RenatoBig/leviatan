<?php 
if(!empty($items)) {
	foreach($items as $item) {
  		echo $item['Item']['name']."\n";
 	}
}else {
 echo 'No results';
}
?>