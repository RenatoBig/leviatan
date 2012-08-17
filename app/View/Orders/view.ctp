<style>
.page-break{page-break-before: always}
</style>
<?php
$unities = array();
foreach($data as $value):
	echo '<p>Ofício: '.$value['Unity']['name'];
	foreach($value['solicitations'] as $key=>$solicitation):
		echo ', '.$solicitation['Solicitation']['memo_number'].'<span style="float: right;">'.$this->Utils->full_date($solicitation['Solicitation']['created']).'</span></p>';
		echo '<br><br>';
		echo 'Da '.$value['Sector']['name'];
		echo '<br>';
		echo 'A Secretaria de Saúde';
		echo '<br>';
		echo 'nome_da_secretária';
		echo '<br><br><br>';
		echo '<p style="margin-left:50%;">Ilma Secretaria, </p>';
		echo '<br><br>';
		echo '<div style="margin-left:30%; margin-right:20%;">';
		echo $solicitation['Solicitation']['description'];
		echo '</div>';	
		echo '<br><br>';
		echo '<p style="margin-left:50%;">Respeitosamente,</p>';
		echo '<br><br>';
		echo '<p style="margin-left:60%;">'.$value['Employee']['name'].' '.$value['Employee']['surname'].'</p>';
		echo '<div class="page-break"></div>';
		echo 'ITENS SOLICITADOS';
		echo '<br><br>';
		echo '<table border="1">';
			echo '<thead>';
				echo '<tr>';
					echo '<th>Código</th>';
					echo '<th>Item</th>';
					echo '<th>Quantidade</th>';
				echo '</tr>';
			echo '</thead>';
			echo '<tbody>';
			foreach($value['solicitation_items'][$key] as $item):
				echo '<tr>';
					echo '<td align="center">'.$item['Item']['keycode'].'</td>';
					echo '<td align="center">'.$item['Item']['name'].'</td>';
					echo '<td align="center">'.$item['SolicitationItem']['quantity'].'</td>';
				echo '</tr>';
			endforeach;
			echo '</tbody>';
		echo '</table>';
		echo '<div class="page-break"></div>';
	endforeach;	
	?>
	<div class="page-break"></div>
	<?php 
endforeach;
?>
