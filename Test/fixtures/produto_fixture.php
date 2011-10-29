<?php
/**
 * Fixture de Produto
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @author        Juan Basso <jrbasso@gmail.com>
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * Produto Fixture
 *
 */
class ProdutoFixture extends CakeTestFixture {

/**
 * Nome do fixture
 *
 * @var string
 * @access public
 */
	var $name = 'Produto';

/**
 * Campos da tabela
 *
 * @var array
 * @access public
 */
	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'nome' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'valor' => array('type' => 'float', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Registros
 *
 * @var array
 * @access public
 */
	var $records = array(
		array(
			'id' => 1,
			'nome' => 'Produto 1',
			'valor' => 1.99
		),
		array(
			'id' => 2,
			'nome' => 'Produto 2',
			'valor' => 1000.20
		),
		array(
			'id' => 3,
			'nome' => 'Produto 3',
			'valor' => 1999000.00
		)
	);
}
