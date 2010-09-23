<?php
/**
 * Teste do Model EstadoBrasileiro
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @author        Juan Basso <jrbasso@gmail.com>
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

App::import('Model', 'CakePtbr.EstadoBrasileiro');

/**
 * EstadoBrasileiro Test Case
 *
 */
class EstadoBrasileiroTestCase extends CakeTestCase {

/**
 * EstadoBrasileiro
 *
 * @var object
 * @access public
 */
	var $EstadoBrasileiro = null;

/**
 * start
 *
 * @retun void
 * @access public
 */
	function start() {
		parent::start();
		$this->EstadoBrasileiro = new EstadoBrasileiro();
	}

/**
 * testInstance
 *
 * @retun void
 * @access public
 */
	function testInstance() {
		$this->assertTrue(is_a($this->EstadoBrasileiro, 'EstadoBrasileiro'));
	}

/**
 * testFind
 *
 * @retun void
 * @access public
 */
	function testFind() {
		$results = $this->EstadoBrasileiro->find('list');
		$this->assertEqual(count($results), 27);

		$results = $this->EstadoBrasileiro->find('all');
		$this->assertTrue(is_array($results['EstadoBrasileiro']));
		$this->assertEqual(count($results['EstadoBrasileiro']), 27);

		$results = $this->EstadoBrasileiro->find('first');
		$this->assertFalse($results);
	}

/**
 * testListaEstados
 *
 * @retun void
 * @access public
 */
	function testListaEstados() {
		$results = $this->EstadoBrasileiro->listaEstados();
		$this->assertEqual(count($results), 27);
		$this->assertEqual($results, $this->EstadoBrasileiro->find('list'));
		$this->assertTrue(isset($results['DF']));

		$results = $this->EstadoBrasileiro->listaEstados(false);
		$this->assertEqual(count($results), 26);
		$this->assertFalse(isset($results['DF']));
	}

/**
 * testTodosEstados
 *
 * @retun void
 * @access public
 */
	function testTodosEstados() {
		$results = $this->EstadoBrasileiro->todosEstados();
		$this->assertTrue(is_array($results['EstadoBrasileiro']));
		$this->assertEqual(count($results['EstadoBrasileiro']), 27);
		$this->assertEqual($results, $this->EstadoBrasileiro->find('all'));

		$results = $this->EstadoBrasileiro->todosEstados(false);
		$this->assertTrue(is_array($results['EstadoBrasileiro']));
		$this->assertEqual(count($results['EstadoBrasileiro']), 26);
	}

/**
 * testEstadoPorSigla
 *
 * @retun void
 * @access public
 */
	function testEstadoPorSigla() {
		$results = $this->EstadoBrasileiro->estadoPorSigla('SC');
		$this->assertEqual($results, 'Santa Catarina');

		$results = $this->EstadoBrasileiro->estadoPorSigla('SP');
		$this->assertEqual($results, 'São Paulo');

		$results = $this->EstadoBrasileiro->estadoPorSigla('XX');
		$this->assertIdentical($results, false);
	}

/**
 * testSiglaPorEstado
 *
 * @retun void
 * @access public
 */
	function testSiglaPorEstado() {
		$results = $this->EstadoBrasileiro->siglaPorEstado('Santa Catarina');
		$this->assertEqual($results, 'SC');

		$results = $this->EstadoBrasileiro->siglaPorEstado('São Paulo');
		$this->assertEqual($results, 'SP');

		$results = $this->EstadoBrasileiro->siglaPorEstado('Sao Paulo');
		$this->assertFalse($results);
	}

/**
 * testEstadosDoSul
 *
 * @retun void
 * @access public
 */
	function testEstadosDoSul() {
		$results = $this->EstadoBrasileiro->estadosDoSul();
		$expected = array(
			'PR' => 'Paraná',
			'RS' => 'Rio Grande do Sul',
			'SC' => 'Santa Catarina'
		);
		$this->assertEqual($results, $expected);
	}

/**
 * testEstadosDoSudeste
 *
 * @retun void
 * @access public
 */
	function testEstadosDoSudeste() {
		$results = $this->EstadoBrasileiro->estadosDoSudeste();
		$expected = array(
			'ES' => 'Espírito Santo',
			'MG' => 'Minas Gerais',
			'RJ' => 'Rio de Janeiro',
			'SP' => 'São Paulo'
		);
		$this->assertEqual($results, $expected);
	}

/**
 * testEstadosDoCentroOeste
 *
 * @retun void
 * @access public
 */
	function testEstadosDoCentroOeste() {
		$results = $this->EstadoBrasileiro->estadosDoCentroOeste();
		$expected = array(
			'DF' => 'Distrito Federal',
			'GO' => 'Goiás',
			'MT' => 'Mato Grosso',
			'MS' => 'Mato Grosso do Sul'
		);
		$this->assertEqual($results, $expected);

		$results = $this->EstadoBrasileiro->estadosDoCentroOeste(false);
		unset($expected['DF']);
		$this->assertEqual($results, $expected);
	}

/**
 * testEstadosDoNorte
 *
 * @retun void
 * @access public
 */
	function testEstadosDoNorte() {
		$results = $this->EstadoBrasileiro->estadosDoNorte();
		$expected = array(
			'AC' => 'Acre',
			'AP' => 'Amapá',
			'AM' => 'Amazonas',
			'PA' => 'Pará',
			'RO' => 'Rondônia',
			'RR' => 'Roraima',
			'TO' => 'Tocantins'
		);
		$this->assertEqual($results, $expected);
	}

/**
 * testEstadosDoNordeste
 *
 * @retun void
 * @access public
 */
	function testEstadosDoNordeste() {
		$results = $this->EstadoBrasileiro->estadosDoNordeste();
		$expected = array(
			'AL' => 'Alagoas',
			'BA' => 'Bahia',
			'CE' => 'Ceará',
			'MA' => 'Maranhão',
			'PB' => 'Paraíba',
			'PI' => 'Piauí',
			'PE' => 'Pernambuco',
			'RN' => 'Rio Grande do Norte',
			'SE' => 'Sergipe'
		);
		$this->assertEqual($results, $expected);
	}

}
