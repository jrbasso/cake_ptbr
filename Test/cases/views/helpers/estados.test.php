<?php
/**
 * Testes do helper de estados
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @author        Juan Basso <jrbasso@gmail.com>
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

App::import('Helper', array('CakePtbr.Estados', 'Form', 'Html'));
App::import('Vendor', 'CakePtbr.Estados');

/**
 * Controller Test
 *
 */
class ControllerTestController extends Controller {

/**
 * Nome do controller
 *
 * @var string
 * @access public
 */
	var $name = 'ControllerTest';

/**
 * Uses
 *
 * @var array
 * @access public
 */
	var $uses = null;
}

/**
 * Estado Test Case
 *
 */
class CakePtbrEstadosCase extends CakeTestCase {

/**
 * Estados
 *
 * @var object
 * @access public
 */
	var $Estados = null;

/**
 * Lista dos estados
 *
 * @var string
 * @access public
 */
	var $listaEstados;

/**
 * setUp
 *
 * @retun void
 * @access public
 */
	function setUp() {
		parent::setUp();
		$this->Estados =& new EstadosHelper();
		$this->Estados->Form =& new FormHelper();
		$this->Estados->Form->Html =& new HtmlHelper();
		$this->Controller =& new ControllerTestController();
		$this->View =& new View($this->Controller);

		$this->listaEstados = Estados::lista();
	}

/**
 * testSelect
 *
 * @retun void
 * @access public
 */
	function testSelect() {
		$expected = array('select' => array('name' => 'data[Model][uf]', 'id' => 'ModelUf'));
		foreach ($this->listaEstados as $sigla => $nome) {
			$expected[] = array('option' => array('value' => $sigla));
			$expected[] = $nome;
			$expected[] = '/option';
		}
		$expected[] = '/select';
		$result = $this->Estados->select('Model.uf');
		$this->assertTags($result, $expected);

		$expected = array('select' => array('name' => 'data[Model][uf]', 'id' => 'ModelUf'));
		foreach ($this->listaEstados as $sigla => $nome) {
			$expected[] = array('option' => array('value' => $sigla));
			$expected[] = $sigla;
			$expected[] = '/option';
		}
		$expected[] = '/select';
		$result = $this->Estados->select('Model.uf', null, array('uf' => true));
		$this->assertTags($result, $expected);
	}

}
