<?php
echo '<h3 align="center">Solicitação</h3>';
echo '<br><br>';
echo '<b>Numero:</b> '.$data[0]['Solicitation']['keycode'];
echo '<br><br>';
echo '<b>Data:</b> '.$this->Time->format('d/m/Y', $data[0]['Solicitation']['created']);
echo '<br><br>';
echo '<b>DESCRIÇÃO DA SOLICITAÇÃO:</b>';
echo '<br>';
echo $data[0]['Solicitation']['description'];
echo '<br>';
echo '<b>ITENS SOLICITADOS</b>';
echo '<br><br>';
echo '<table border="1">';
	echo '<thead>';
		echo '<tr>';
			echo '<th>Código</th>';
			echo '<th>Item</th>';
			echo '<th>Descrição</th>';
			echo '<th>Quantidade</th>';
		echo '</tr>';
	echo '</thead>';
	echo '<tbody>';	
	foreach($data as $value):	
		echo '<tr>';
			echo '<td align="center">'.$value['Item']['keycode'].'</td>';
			echo '<td align="center">'.$value['Item']['name'].'</td>';
			echo '<td>'.$value['Item']['description'].'</td>';
			echo '<td align="center">'.$value['SolicitationItem']['quantity'].'</td>';
		echo '</tr>';		
	endforeach;
	echo '</tbody>';
echo '</table>';
?>
