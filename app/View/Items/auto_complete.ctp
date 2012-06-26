<?php 
if(!empty($items)) {
	foreach($items as $item) {
	  echo $item['Item']['name']. '|' .$item['Item']['id'] . "\n";
	 }
	}
else {
 	echo 'No results';
}
?>