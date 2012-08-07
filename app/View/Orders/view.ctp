<?php
echo '<h3>PEDIDO</h3>';
echo '<br><br>';
foreach($data as $value):
	//if(!empty($value['items'])):
		echo 'Solicitante: '.$value['Employee']['name'];
		echo '<br>';
		echo 'Unidade: '.$value['Unity']['name'];
		echo '<br><br>';
		foreach($value['solicitations'] as $key=>$solicitation):
			echo 'DESCRIÇÃO DA SOLICITAÇÃO : ';
			echo '<br><br>';
			echo $solicitation['Solicitation']['description'];	
			echo '<br><br>';
			echo 'ITENS SOLICITADOS';
			echo '<br><br>';
			echo '<table class="table">';
				echo '<thead>';
					echo '<tr>';
						echo '<th>Código</th>';
						echo '<th>Item</th>';
						echo '<th>Descrição</th>';
						echo '<th>Quantidade</th>';
					echo '</tr>';
				echo '</thead>';
				echo '<tbody>';
				foreach($value['solicitation_items'][$key] as $item):
					echo '<tr>';
						echo '<td>'.$item['Item']['keycode'].'</td>';
						echo '<td align="center">'.$item['Item']['name'].'</td>';
						echo '<td>'.$item['Item']['description'].'</td>';
						echo '<td align="center">'.$item['SolicitationItem']['quantity'].'</td>';
					echo '</tr>';
				endforeach;
				echo '</tbody>';
			echo '</table>';
			echo '<hr>';
		endforeach;
		
		echo '<br><br>';
	//endif;
endforeach;
?>
