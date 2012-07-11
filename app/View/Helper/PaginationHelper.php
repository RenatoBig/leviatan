<?php
class PaginationHelper extends AppHelper {

	private $_qtdeRegistros;
	private $_paginaAtual;
	private $_totalRegistros;
	private $_model;


	public function __construct() {

	}

	public function paginaAtual() {
		if (!isset($_GET["page{$this->_model}"])) {
			$paginaAtual= 1;
		} else {
			$paginaAtual = $_GET["page{$this->_model}"];
		}
		$this->_paginaAtual = $paginaAtual;
	}

	public function primeiroRegistro() {
		return ($this->_paginaAtual * $this->_qtdeRegistros) - $this->_qtdeRegistros;
	}

	public function ultimoRegistro() {
		return ($this->_qtdeRegistros + $this->primeiroRegistro());
	}

	public function getPaginaAtual() {
		return $this->_paginaAtual;
	}

	public function getPaginacao() {

		$paginacao = '';

		// Calculando pagina anterior
	    $menos = $this->_paginaAtual - 1;

		// Calculando pagina posterior
	    $mais = $this->_paginaAtual + 1;

		$pgs = ceil($this->_totalRegistros/ $this->_qtdeRegistros);

	    if($pgs > 1 ) {
	        // Mostragem de pagina
	        if ($menos > 0) {
	           $paginacao .= "<li><a href='?page{$this->_model}={$menos}' class='sprites pgant'>anterior</a></li>";
	        }
	        // Listando as paginas
	        for($i=1; $i <= $pgs; $i++) {
	        	if ($i == $this->_paginaAtual) {
	        		$paginacao .= "<li><a class='pgsel current' href='#'><strong>{$i}</strong></a></li>";
	        	} else {
	        		$paginacao .= "<li><a href='?page{$this->_model}={$i}' >{$i}</a></li>";
	        	}
	        }
	        if ($mais <= $pgs) {
	           $paginacao .= "<li><a href='?page{$this->_model}={$mais}' class='sprites pgpro'>próxima</a></li>";
	        }
    	}

    	return $paginacao;
	}

	public function setQtdeRegistros($qtde) {
		$this->_qtdeRegistros = $qtde;
	}

	public function getQtdeRegistros() {
		return $this->_qtdeRegistros;
	}

	public function setTotalregistros($total) {
		$this->_totalRegistros = $total;
	}

	public function getTotalRegistros() {
		return $this->_totalRegistros;
	}

	public function setModel($model) {
		$this->_model = $model;
	}

	public function getModel() {
		return $this->_model;
	}
}
