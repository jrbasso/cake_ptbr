<?php
/**
 * Testes das funções de internacionalização
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @author        Juan Basso <jrbasso@gmail.com>
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

include dirname(dirname(dirname(dirname(__FILE__)))) . DS . 'config' . DS . 'traducao_core.php';

/**
 * I18n Test Case
 *
 */
class CakePtbrI18nCase extends CakeTestCase {

/**
 * testCore
 *
 * @retun void
 * @access public
 */
	function testCore() {
		$this->assertEqual(__('Missing Component File', true), 'Arquivo de Component não encontrado');
		$this->assertEqual(__d('default', 'Missing Database', true), 'Database não encontrado');
	}

/**
 * testTimeDefinition
 *
 * @retun void
 * @access public
 */
	function testTimeDefinition() {
		$result = __c('abday', 5, true);
		$expected = array('Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab');
		$this->assertEqual($result, $expected);

		$result = __c('day', 5, true);
		$expected = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado');
		$this->assertEqual($result, $expected);

		$result = __c('abmon', 5, true);
		$expected = array('Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez');
		$this->assertEqual($result, $expected);

		$result = __c('mon', 5, true);
		$expected = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
		$this->assertEqual($result, $expected);

		$result = __c('d_fmt', 5, true);
		$expected = '%d/%m/%Y';
		$this->assertEqual($result, $expected);

		$result = __c('am_pm', 5, true);
		$expected = array('AM', 'PM');
		$this->assertEqual($result, $expected);
	}
}
