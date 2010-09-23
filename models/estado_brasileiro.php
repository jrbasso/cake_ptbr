<?php
/**
 * Model com as informações dos estados brasileiros
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @author        Juan Basso <jrbasso@gmail.com>
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * EstadoBrasileiro
 *
 * @link http://wiki.github.com/jrbasso/cake_ptbr/model-estadobrasileiro
 */
class EstadoBrasileiro extends AppModel {

/**
 * Nome do model
 *
 * @var string
 * @access public
 */
	var $name = 'EstadoBrasileiro';

/**
 * Usar tabela?
 *
 * @var boolean
 * @access public
 */
	var $useTable = false;

/**
 * Construtor
 *
 * @param mixed $id
 * @param string $table
 * @param string $ds
 * @access private
 */
	function __construct($id = false, $table = null, $ds = null) {
		parent::__construct();

		App::import('Vendor', 'CakePtbr.Estados');
		$this->_estados = Estados::lista();
	}

/**
 * Find
 *
 * @param array $conditions
 * @param mixed $fields
 * @param string $order
 * @param integer $recursive
 * @return array
 * @access public
 */

	function find($conditions = null, $fields = array(), $order = null, $recursive = null) {
		if (is_string($conditions)) {
			switch ($conditions) {
				case 'list':
					return $this->listaEstados();
				case 'all':
					return $this->todosEstados();
			}
		}
		return false;
	}

/**
 * Lista dos estados na forma do list
 *
 * @param boolean $incluirDF Incluir Distrito Federal na lista?
 * @return array Lista dos estados
 * @access public
 */
	function listaEstados($incluirDF = true) {
		if ($incluirDF) {
			return $this->_estados;
		}
		$estados = $this->_estados;
		unset($estados['DF']);
		return $estados;
	}

/**
 * Lista dos estados na forma do find
 *
 * @param boolean $incluirDF Incluir Distrito Federal na lista?
 * @return array Lista dos estados
 * @access public
 */
	function todosEstados($incluirDF = true) {
		$estados = array('EstadoBrasileiro' => array());
		foreach ($this->_estados as $sigla => $nome) {
			if (!$incluirDF && $sigla === 'DF') {
				continue;
			}
			$estados['EstadoBrasileiro'][] = array(
				'sigla' => $sigla,
				'nome' => $nome
			);
		}
		return $estados;
	}

/**
 * Nome do estado conforme a sigla
 *
 * @param string $sigla Sigla do estado
 * @return string Nome do estado. False quando sigla for inválida
 * @access public
 */
	function estadoPorSigla($sigla) {
		if (isset($this->_estados[$sigla])) {
			return $this->_estados[$sigla];
		}
		return false;
	}

/**
 * Sigla do estado conforme o nome
 *
 * @param string $estado
 * @return string Sigla do estado. False quando estado for inválido
 * @access public
 */
	function siglaPorEstado($estado) {
		if ($sigla = array_search($estado, $this->_estados)) {
			return $sigla;
		}
		return false;
	}

/**
 * Lista dos estados do sul
 *
 * @return array Lista dos estados do sul
 * @access public
 */
	function estadosDoSul() {
		return $this->_estadosPorRegiao(array('PR', 'RS', 'SC'));
	}

/**
 * Lista dos estados do sudeste
 *
 * @return array Lista dos estados do sudeste
 * @access public
 */
	function estadosDoSudeste() {
		return $this->_estadosPorRegiao(array('ES', 'MG', 'RJ', 'SP'));
	}

/**
 * Lista dos estados do centro oeste
 *
 * @param boolean $incluirDF Incluir Distrito Federal?
 * @return array Lista dos estados do centro oeste
 * @access public
 */
	function estadosDoCentroOeste($incluirDF = true) {
		if ($incluirDF) {
			return $this->_estadosPorRegiao(array('DF', 'GO', 'MT', 'MS'));
		}
		return $this->_estadosPorRegiao(array('GO', 'MT', 'MS'));
	}

/**
 * Lista dos estados do norte
 *
 * @return array Lista dos estados do norte
 * @access public
 */
	function estadosDoNorte() {
		return $this->_estadosPorRegiao(array('AC', 'AP', 'AM', 'PA', 'RO', 'RR', 'TO'));
	}

/**
 * Lista dos estados do norteste
 *
 * @return array Lista dos estados do norteste
 * @access public
 */
	function estadosDoNordeste() {
		return $this->_estadosPorRegiao(array('AL', 'BA', 'CE', 'MA', 'PB', 'PI', 'PE', 'RN', 'SE'));
	}

/**
 * Método auxiliar para pegar os estados
 *
 * @param array $estados Listas dos estados que deseja filtrar
 * @return array Lista dos estados
 * @access protected
 */
	function _estadosPorRegiao($estados) {
		$retorno = array();
		foreach ($estados as $estado) {
			$retorno[$estado] = $this->_estados[$estado];
		}
		return $retorno;
	}

}
