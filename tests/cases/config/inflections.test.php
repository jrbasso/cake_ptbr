<?php
/**
 * Testes das regras de pluralização e singularização
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @author        Juan Basso <jrbasso@gmail.com>
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

include dirname(dirname(dirname(dirname(__FILE__)))) . DS . 'config' . DS . 'inflections.php';

/**
 * Inflections Test Case
 *
 */
class CakePtbrInflectionsCase extends CakeTestCase {

/**
 * testPlural
 *
 * @retun void
 * @access public
 */
	function testPlural() {
		$this->assertEqual(Inflector::pluralize('Compra'), 'Compras');
		$this->assertEqual(Inflector::pluralize('Caminhao'), 'Caminhoes');
		$this->assertEqual(Inflector::pluralize('Motor'), 'Motores');
		$this->assertEqual(Inflector::pluralize('Bordel'), 'Bordeis');
		$this->assertEqual(Inflector::pluralize('palavra_chave'), 'palavra_chaves');
		$this->assertEqual(Inflector::pluralize('Abril'), 'Abris');
		$this->assertEqual(Inflector::pluralize('Azul'), 'Azuis');
		$this->assertEqual(Inflector::pluralize('Alcool'), 'Alcoois');
		// irregulares
		$this->assertEqual(Inflector::pluralize('Perfil'), 'Perfis');
		$this->assertEqual(Inflector::pluralize('Alemao'), 'Alemaes');
		$this->assertEqual(Inflector::pluralize('Mao'), 'Maos');
		$this->assertEqual(Inflector::pluralize('Cao'), 'Caes');
		$this->assertEqual(Inflector::pluralize('Reptil'), 'Repteis');
		$this->assertEqual(Inflector::pluralize('Sotao'), 'Sotaos');
		$this->assertEqual(Inflector::pluralize('Pais'), 'Paises');
		$this->assertEqual(Inflector::pluralize('Pai'), 'Pais');
	}

/**
 * testSingular
 *
 * @retun void
 * @access public
 */
	function testSingular() {
		$this->assertEqual(Inflector::singularize('Compras'), 'Compra');
		$this->assertEqual(Inflector::singularize('Caminhoes'), 'Caminhao');
		$this->assertEqual(Inflector::singularize('Motores'), 'Motor');
		$this->assertEqual(Inflector::singularize('Bordeis'), 'Bordel');
		$this->assertEqual(Inflector::singularize('palavras_chaves'), 'palavras_chave');
		$this->assertEqual(Inflector::singularize('Abris'), 'Abril');
		$this->assertEqual(Inflector::singularize('Azuis'), 'Azul');
		$this->assertEqual(Inflector::singularize('Alcoois'), 'Alcool');
		// irregulares
		$this->assertEqual(Inflector::singularize('Perfis'), 'Perfil');
		$this->assertEqual(Inflector::singularize('Alemaes'), 'Alemao');
		$this->assertEqual(Inflector::singularize('Maos'), 'Mao');
		$this->assertEqual(Inflector::singularize('Caes'), 'Cao');
		$this->assertEqual(Inflector::singularize('Repteis'), 'Reptil');
		$this->assertEqual(Inflector::singularize('Sotaos'), 'Sotao');
		$this->assertEqual(Inflector::singularize('Paises'), 'Pais');
		$this->assertEqual(Inflector::singularize('Pais'), 'Pai');
	}

/**
 * testNaoPluralizaveis
 *
 * @retun void
 * @access public
 */
	function testNaoPluralizaveis() {
		// singularize
		$this->assertEqual(Inflector::singularize('Atlas'), 'Atlas');
		$this->assertEqual(Inflector::singularize('Lapis'), 'Lapis');
		$this->assertEqual(Inflector::singularize('Onibus'), 'Onibus');
		$this->assertEqual(Inflector::singularize('Pires'), 'Pires');
		$this->assertEqual(Inflector::singularize('Virus'), 'Virus');
		$this->assertEqual(Inflector::singularize('Torax'), 'Torax');
		// pluralize
		$this->assertEqual(Inflector::pluralize('Atlas'), 'Atlas');
		$this->assertEqual(Inflector::pluralize('Lapis'), 'Lapis');
		$this->assertEqual(Inflector::pluralize('Onibus'), 'Onibus');
		$this->assertEqual(Inflector::pluralize('Pires'), 'Pires');
		$this->assertEqual(Inflector::pluralize('Virus'), 'Virus');
		$this->assertEqual(Inflector::pluralize('Torax'), 'Torax');
	}

/**
 * testSlug
 *
 * @retun void
 * @access public
 */
	function testSlug() {
		$this->assertEqual(Inflector::slug('João'), 'Joao');
		$this->assertEqual(Inflector::slug('Conseqüência'), 'Consequencia');
		$this->assertEqual(Inflector::slug('Linguiça não útil água'), 'Linguica_nao_util_agua');
		$this->assertEqual(Inflector::slug('ÃÓ&'), 'AOe');
		$this->assertEqual(Inflector::slug('äü au Sandoval'), 'au_au_Sandoval');
	}

}
