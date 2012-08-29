<?php
$unities = array();
$quantitites = array();
$sum = array();
foreach($data as $master_key=>$value):
	$unities[] = $value;

	echo '<div class="title">';
	echo '<p>Memorando: '.$value['Unity']['name'];	
	echo ', '.$value['Solicitation']['memo_number'].'</p>';
	echo '<p>'.$this->Utils->full_date($value['Solicitation']['created']).'</p>';
	echo '</div>';
	
	//----------------------------------
	echo '<div class="general_information">';
		echo '<p>Da '.$value['Sector']['name'].'</p>';
		echo '<p>A Secretaria de Saúde</p>';
		echo '<p>nome_da_secretária</p>';
	echo '</div>';
	//-----------------------------------
	echo '<div class="treatment">';
		echo 'Ilma Secretaria,';
	echo '</div>';
	//-----
	echo '<div class="description_memo">';
		echo $value['Solicitation']['description'];
	echo '</div>';
	//-------	
	echo '<div class="respectfully">';
		echo 'Respeitosamente,';
	echo '</div>';
	//-----------------------
	echo '<div class="signature">';
		echo $value['Employee']['name'].' '.$value['Employee']['surname'];
	echo '</div>';
	//--------------------
	//Pula página
	echo '<div class="page-break"></div>';
	
	//------
	//Itens da solicitação
	//----------------
	echo '<div class="title">';
		echo '<p>Unidade : '.$value['Unity']['name'].'</p>';
		echo '<p>Setor: '.$value['Sector']['name'].'</p>';
		echo '<p>Nº do memorando: '.$value['Solicitation']['memo_number'].'</p>';
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
		foreach($value['solicitation_items'] as $item):
			echo '<tr>';
				echo '<td>'.$item['Item']['keycode'].'</td>';
				echo '<td>'.$item['Item']['name'].'</td>';
				echo '<td>'.$item['SolicitationItem']['quantity'].'</td>';
				$quantities[$item['Item']['keycode']] = array($item['SolicitationItem']['id'], $item['SolicitationItem']['quantity']);
			echo '</tr>';
		endforeach;
		echo '</tbody>';
	echo '</table>';
	if($master_key < count($data)) {
		echo '<div class="page-break"></div>';
	}	
endforeach;
//Consolidado
//--------------------------------
echo '<div class="title-center">';
	echo '<h3>Consolidado das solicitações</h3>';
echo'</div>';
echo '<table class="table table-bordered table-condesed">';
	echo '<thead>';
		echo '<tr>';
			echo '<th>COD</th>';
			echo '<th>Nome</th>';
			foreach($unities as $unity):
				echo '<th>'.$unity['Unity']['name'].'</th>';
			endforeach;
			echo '<th>Total</th>';
		echo '</tr>';
	echo '</thead>';
	echo '<tbody>';	
		foreach($distinct_items as $key=>$i):
			echo '<tr>';
				echo '<td>'.$i['Item']['keycode'].'</td>';
				echo '<td id="description">'.$i['Item']['name'].'</td>';
				$total = 0;
				for($j = 0; $j < count($unities); $j++) {
					$flag = true;
					foreach($t[$i['Item']['id']] as $v):						
						if($v['Unity']['id'] == $unities[$j]['Unity']['id']) {
							echo '<td>'.$v['SolicitationItem']['quantity'].'</td>';
							$total += $v['SolicitationItem']['quantity'];
							$flag = false;
						}
					endforeach;
					if($flag) {
						echo '<td> - </td>';
					}
				}	
				$sum[] = $total;			
				echo '<td>'.$total.'</td>';
			echo '</tr>';
		endforeach;
	echo '</tbody>';
echo '</table>';
//fim consolidado
//--------------------
echo '<div class="page-break"></div>';
//Descrição dos itens
//-------------------
echo '<div class="title-center">';
	echo '<h3>Descrição dos itens</h3>';
echo'</div>';
echo '<table class="table table-bordered table-condesed">';
	echo '<thead>';
		echo '<tr>';
			echo '<th>COD</th>';
			echo '<th>Descrição</th>';
			echo '<th>Total</th>';
		echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
		foreach($distinct_items as $key=>$i):
			echo '<tr>';
				echo '<td>'.$i['Item']['keycode'].'</td>';
				echo '<td id="description">'.$i['Item']['description'].'</td>';
				echo '<td>'.$sum[$key].'</td>';
			echo '</tr>';
		endforeach;
	echo '</tbody>';
echo '</table>';
?>
