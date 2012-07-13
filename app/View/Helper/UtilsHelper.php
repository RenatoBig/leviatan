<?php
class UtilsHelper extends AppHelper {
	
	/**
	 * 
	 * Retorna o nome do status passado como parâmetro
	 * @param int $id
	 */
	public function nameStatus($id) {
		
		$status = '';
		
		switch($id):
			case ATIVO:
				$status = '<span class="label label-success">Ativo</span>';
				break;
			case INATIVO:
				$status = '<span class="label label-important">Inativo</span>';
				break;
			case PENDENTE:
				$status = '<span class="label label-info">Pendente</span>';
				break;
			case HOMOLOGADO:
				$status = '<span class="label label-success">Homologado</span>';
				break;
			case APROVADO:
				$status = '<span class="label label-success">Aprovado</span>';
				break;
			case NEGADO:
				$status = '<span class="label label-important">Negado</span>';
				break;
			case CONCLUIDO:
				$status = '<span class="label">Concluído</span>';
				break;
			default:
				$status = '<span class="label label-info">Indefinido</span>';
		endswitch;
		
		return $status;
	}	
}