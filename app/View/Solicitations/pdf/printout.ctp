<?php

echo '<div class="title">';
	echo '<p>Memorando: '.$data[0]['Unity']['name'];
	echo ', '.$data[0]['Solicitation']['memo_number'].'</p>';
	echo '<p>'.$this->Utils->full_date($data[0]['Solicitation']['created']).'</p>';
echo '</div>';
//----------------------------------
echo '<div class="general_information">';
echo '<p>Da '.$data[0]['Sector']['name'].'</p>';
echo '<p>A Secretaria de Saúde</p>';
echo '<p>nome_da_secretária</p>';
echo '</div>';
//-----------------------------------
echo '<div class="treatment">';
echo 'Ilma Secretaria,';
echo '</div>';
//-----
echo '<div class="description_memo">';
echo $data[0]['Solicitation']['description'];
echo '</div>';
//-------
echo '<div class="respectfully">';
echo 'Respeitosamente,';
echo '</div>';
//-----------------------
echo '<div class="signature">';
echo $data[0]['Employee']['name'].' '.$data[0]['Employee']['surname'];
echo '</div>';
//--------------------
//Pula página
echo '<div class="page-break"></div>';
//------
//Itens da solicitação
//----------------
echo '<div class="title">';
	echo '<p>Unidade : '.$data[0]['Unity']['name'].'</p>';
	echo '<p>Setor: '.$data[0]['Sector']['name'].'</p>';
	echo '<p>Nº do memorando: '.$data[0]['Solicitation']['memo_number'].'</p>';
echo'</div>';
echo '<table class="table table-bordered">';
	echo '<thead>';
		echo '<tr>';
			echo '<th>Código</th>';
			echo '<th>Item</th>';
			echo '<th>Quantidade</th>';
		echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
		foreach($data as $item):
			echo '<tr>';
				echo '<td>'.$item['Item']['keycode'].'</td>';
				echo '<td>'.$item['Item']['name'].'</td>';
				echo '<td>'.$item['SolicitationItem']['quantity'].'</td>';
			echo '</tr>';
		endforeach;
	echo '</tbody>';
echo '</table>';
//--------------
