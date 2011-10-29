<?php
/**
 * Teste do Behavior AjusteData
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @author        Juan Basso <jrbasso@gmail.com>
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

App::import('Core', 'Model');
App::import('Behavior', 'CakePtbr.AjusteData');

/**
 * CakePtbrNoticia
 *
 */
class CakePtbrNoticia extends Model {

/**
 * Nome da model
 *
 * @var string
 * @access public
 */
	var $name = 'Noticia';

/**
 * Usar tabela?
 *
 * @var boolean
 * @access public
 */
	var $useTable = false;

/**
 * Exists
 *
 * @return boolean
 * @access public
 */
	function exists() {
		return true;
	}
}

/**
 * CakePtbrNoticiaSemNada
 *
 */
class CakePtbrNoticiaSemNada extends CakePtbrNoticia {

/**
 * Nome da model
 *
 * @var string
 * @access public
 */
	var $name = 'CakePtbrNoticiaSemNada';

/**
 * Lista de Behaviors
 *
 * @var array
 * @access public
 */
	var $actsAs = array('CakePtbr.AjusteData');

}

/**
 * CakePtbrNoticiaString
 *
 */
class CakePtbrNoticiaString extends CakePtbrNoticia {

/**
 * Nome da model
 *
 * @var string
 * @access public
 */
	var $name = 'CakePtbrNoticiaString';

/**
 * Lista de Behaviors
 *
 * @var array
 * @access public
 */
	var $actsAs = array('CakePtbr.AjusteData' => 'data');

}

/**
 * CakePtbrNoticiaArrayVazio
 *
 */
class CakePtbrNoticiaArrayVazio extends CakePtbrNoticia {

/**
 * Nome da model
 *
 * @var string
 * @access public
 */
	var $name = 'CakePtbrNoticiaArrayVazio';

/**
 * Lista de Behaviors
 *
 * @var array
 * @access public
 */
	var $actsAs = array('CakePtbr.AjusteData' => array());

}

/**
 * CakePtbrNoticiaArrayComCampo
 *
 */
class CakePtbrNoticiaArrayComCampo extends CakePtbrNoticia {

/**
 * Nome da model
 *
 * @var string
 * @access public
 */
	var $name = 'CakePtbrNoticiaArrayComCampo';

/**
 * Lista de Behaviors
 *
 * @var array
 * @access public
 */
	var $actsAs = array('CakePtbr.AjusteData' => array('data'));

}

/**
 * CakePtbrNoticiaArrayComCampos
 *
 */
class CakePtbrNoticiaArrayComCampos extends CakePtbrNoticia {

/**
 * Nome da model
 *
 * @var string
 * @access public
 */
	var $name = 'CakePtbrNoticiaArrayComCampos';

/**
 * Lista de Behaviors
 *
 * @var array
 * @access public
 */
	var $actsAs = array('CakePtbr.AjusteData' => array('data', 'publicado'));
}

/**
 * AjusteData Test Case
 *
 */
class CakePtbrAjusteData extends CakeTestCase {

/**
 * Envio
 *
 * @var array
 * @access protected
 */
	var $_envio = array(
		'id' => 1,
		'nome' => 'Teste',
		'data' => '20/03/2009',
		'data_falsa' => '30/01/2009',
		'publicado' => '01/01/2010'
	);

/**
 * testSemNada
 *
 * @retun void
 * @access public
 */
	function testSemNada() {
		$esperado = array(
			'CakePtbrNoticiaSemNada' => array(
				'id' => 1,
				'nome' => 'Teste',
				'data' => '20/03/2009',
				'data_falsa' => '30/01/2009',
				'publicado' => '01/01/2010'
			)
		);
		$this->_testModel('CakePtbrNoticiaSemNada', $esperado);
	}

/**
 * testString
 *
 * @retun void
 * @access public
 */
	function testString() {
		$esperado = array(
			'CakePtbrNoticiaString' => array(
				'id' => 1,
				'nome' => 'Teste',
				'data' => '2009-03-20',
				'data_falsa' => '30/01/2009',
				'publicado' => '01/01/2010'
			)
		);
		$this->_testModel('CakePtbrNoticiaString', $esperado);
	}

/**
 * testArrayVazio
 *
 * @retun void
 * @access public
 */
	function testArrayVazio() {
		$esperado = array(
			'CakePtbrNoticiaArrayVazio' => array(
				'id' => 1,
				'nome' => 'Teste',
				'data' => '20/03/2009',
				'data_falsa' => '30/01/2009',
				'publicado' => '01/01/2010'
			)
		);
		$this->_testModel('CakePtbrNoticiaArrayVazio', $esperado);
	}

/**
 * testArrayComCampo
 *
 * @retun void
 * @access public
 */
	function testArrayComCampo() {
		$esperado = array(
			'CakePtbrNoticiaArrayComCampo' => array(
				'id' => 1,
				'nome' => 'Teste',
				'data' => '2009-03-20',
				'data_falsa' => '30/01/2009',
				'publicado' => '01/01/2010'
			)
		);
		$this->_testModel('CakePtbrNoticiaArrayComCampo', $esperado);
	}

/**
 * testArrayComCampos
 *
 * @retun void
 * @access public
 */
	function testArrayComCampos() {
		$esperado = array(
			'CakePtbrNoticiaArrayComCampos' => array(
				'id' => 1,
				'nome' => 'Teste',
				'data' => '2009-03-20',
				'data_falsa' => '30/01/2009',
				'publicado' => '2010-01-01'
			)
		);
		$this->_testModel('CakePtbrNoticiaArrayComCampos', $esperado);
	}

/**
 * Método auxiliar para executar os testes
 *
 * @param string $nomeModel Nome da model
 * @param array $esperado Valor esperado
 * @retun void
 * @access protected
 */
	function _testModel($nomeModel, $esperado) {
		$Model = new $nomeModel();
		$Model->create();
		$Model->save(array($nomeModel => $this->_envio));
		$this->assertEqual($Model->data, $esperado);
	}

}
