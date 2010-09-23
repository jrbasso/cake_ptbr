<?php
/**
 * Teste do Behavior AjusteFloat
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @author        Juan Basso <jrbasso@gmail.com>
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

App::import('Core', 'Model');
App::import('Behavior', 'CakePtbr.AjusteFloat');

/**
 * Produto
 *
 */
class Produto extends CakeTestModel {

/**
 * Nome da model
 *
 * @var string
 * @access public
 */
	var $name = 'Produto';

/**
 * Lista de Behaviors
 *
 * @var array
 * @access public
 */
	var $actsAs = array('CakePtbr.AjusteFloat');
}

/**
 * AjusteFloat Test Case
 *
 */
class CakePtbrAjusteFloat extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 * @access public
 */
	var $fixtures = array('plugin.cake_ptbr.produto');

/**
 * Produto
 *
 * @var object
 * @access public
 */
	var $Produto = null;

/**
 * startTest
 *
 * @retun void
 * @access public
 */
	function startTest() {
		$this->Produto =& ClassRegistry::init('Produto');
	}

/**
 * testFind
 *
 * @retun void
 * @access public
 */
	function testFind() {
		$result = $this->Produto->find('all');
		$expected = array(
			array(
				'Produto' => array(
					'id' => 1,
					'nome' => 'Produto 1',
					'valor' => '1,99'
				)
			),
			array(
				'Produto' => array(
					'id' => 2,
					'nome' => 'Produto 2',
					'valor' => '1.000,20'
				)
			),
			array(
				'Produto' => array(
					'id' => 3,
					'nome' => 'Produto 3',
					'valor' => '1.999.000,00'
				)
			)
		);
		$this->assertEqual($result, $expected);
	}

/**
 * testSave
 *
 * @retun void
 * @access public
 */
	function testSave() {
		$data = array(
			'Produto' => array(
				'nome' => 'Produto 4',
				'valor' => '5.000,00'
			)
		);
		$this->Produto->create();
		$this->assertTrue($this->Produto->save($data));

		$id = $this->Produto->getInsertId();
		$data['Produto']['id'] = $id;
		$result = $this->Produto->read(null, $id);
		$this->assertEqual($data, $result);

		$result = $this->Produto->read(array('valor'), $id);
		$this->assertEqual(array('Produto' => array('valor' => '5.000,00')), $result);

		$result = $this->Produto->read(array('nome'), $id); // Verificar se dá erro quando não vem o campo
		$this->assertEqual(array('Produto' => array('nome' => 'Produto 4')), $result);
	}
}
