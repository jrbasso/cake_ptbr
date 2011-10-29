<?php
/**
 * Testes do helper de formatação
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @author        Juan Basso <jrbasso@gmail.com>
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

App::import('Helper', array('CakePtbr.Formatacao', 'Time', 'Number'));

/**
 * Formatacao Test Case
 *
 */
class CakePtbrFormatacaoCase extends CakeTestCase {

/**
 * Formatação
 *
 * @var object
 * @access public
 */
	var $Formatacao = null;

/**
 * setUp
 *
 * @retun void
 * @access public
 */
	function setUp() {
		parent::setUp();
		$this->Formatacao = new FormatacaoHelper();
		$this->Formatacao->Time = new TimeHelper();
		$this->Formatacao->Number = new NumberHelper();
	}

/**
 * testData
 *
 * @retun void
 * @access public
 */
	function testData() {
		$this->assertEqual($this->Formatacao->data(), date('d/m/Y'));
		$this->assertEqual($this->Formatacao->data(strtotime('2009-04-21')), '21/04/2009');
		$this->assertEqual($this->Formatacao->data('2009-04-21'), '21/04/2009');
		$this->assertEqual($this->Formatacao->data('errado', array('invalid' => 'Inválido')), 'Inválido');
		$this->assertEqual($this->Formatacao->data(strtotime('2009-04-21 00:00:00 GMT'), array('userOffset' => '-1')), '20/04/2009');
		$this->assertEqual($this->Formatacao->data('2009-04-21 00:00:00 GMT', array('userOffset' => '-1')), '20/04/2009');
	}

/**
 * testDataHora
 *
 * @retun void
 * @access public
 */
	function testDataHora() {
		$this->assertEqual($this->Formatacao->dataHora(), date('d/m/Y H:i:s'));
		$this->assertEqual($this->Formatacao->dataHora(null, false), date('d/m/Y H:i'));
		$this->assertEqual($this->Formatacao->dataHora(strtotime('2009-04-21 10:20:30')), '21/04/2009 10:20:30');
		$this->assertEqual($this->Formatacao->dataHora(strtotime('2009-04-21 10:20:30'), false), '21/04/2009 10:20');
		$this->assertEqual($this->Formatacao->dataHora('2009-04-21 10:20:30', false), '21/04/2009 10:20');
		$this->assertEqual($this->Formatacao->dataHora('errado', true, array('invalid' => 'Inválido')), 'Inválido');
		$this->assertEqual($this->Formatacao->dataHora(strtotime('2009-04-21 10:20:30 GMT'), false, array('userOffset' => '+2')), '21/04/2009 12:20');
		$this->assertEqual($this->Formatacao->dataHora(strtotime('2009-04-21 10:20:30 GMT'), false, array('userOffset' => '-2')), '21/04/2009 08:20');
		$this->assertEqual($this->Formatacao->dataHora('2009-04-21 10:20:30 GMT', false, array('userOffset' => '-2')), '21/04/2009 08:20');
	}

/**
 * testDataCompleta
 *
 * @retun void
 * @access public
 */
	function testDataCompleta() {
		$this->assertEqual($this->Formatacao->dataCompleta(strtotime('2009-04-21 10:20:30')), 'Terça-feira, 21 de Abril de 2009, 10:20:30');
		$this->assertEqual($this->Formatacao->dataCompleta('2009-04-21 10:20:30'), 'Terça-feira, 21 de Abril de 2009, 10:20:30');
	}

/**
 * testTempo
 *
 * @return void
 * @access public
 */
	function testTempo() {
		$this->assertEqual($this->Formatacao->tempo(), 'menos de 1 minuto');
		$this->assertEqual($this->Formatacao->tempo(strtotime('-1 hour')), '1 hora');
		$this->assertEqual($this->Formatacao->tempo('-1 hour'), '1 hora');
	}

/**
 * testPrecisao
 *
 * @retun void
 * @access public
 */
	function testPrecisao() {
		$this->assertIdentical($this->Formatacao->precisao(-10), '-10,000');
		$this->assertIdentical($this->Formatacao->precisao(0), '0,000');
		$this->assertIdentical($this->Formatacao->precisao(10), '10,000');
		$this->assertIdentical($this->Formatacao->precisao(10.323), '10,323');
		$this->assertIdentical($this->Formatacao->precisao(10.56486), '10,565');
		$this->assertIdentical($this->Formatacao->precisao(10.56486, 2), '10,56');
		$this->assertIdentical($this->Formatacao->precisao(10.56486, 0), '11');
	}

/**
 * testPorcentagem
 *
 * @retun void
 * @access public
 */
	function testPorcentagem() {
		$this->assertEqual($this->Formatacao->porcentagem(-10), '-10,00%');
		$this->assertEqual($this->Formatacao->porcentagem(0), '0,00%');
		$this->assertEqual($this->Formatacao->porcentagem(10), '10,00%');
		$this->assertEqual($this->Formatacao->porcentagem(10, 1), '10,0%');
		$this->assertEqual($this->Formatacao->porcentagem(10.123), '10,12%');
		$this->assertEqual($this->Formatacao->porcentagem(10, 0), '10%');
	}

/**
 * testMoeda
 *
 * @retun void
 * @access public
 */
	function testMoeda() {
		$this->assertEqual($this->Formatacao->moeda(-10), '(R$ 10,00)');
		$this->assertEqual($this->Formatacao->moeda(-10.12), '(R$ 10,12)');
		$this->assertEqual($this->Formatacao->moeda(-0.12), '(R$ 0,12)');
		$this->assertEqual($this->Formatacao->moeda(-0.12, array('negative' => '-')), 'R$ -0,12');
		$this->assertEqual($this->Formatacao->moeda(0), 'R$ 0,00');
		$this->assertEqual($this->Formatacao->moeda(0.5), 'R$ 0,50');
		$this->assertEqual($this->Formatacao->moeda(0.52), 'R$ 0,52');
		$this->assertEqual($this->Formatacao->moeda(10), 'R$ 10,00');
		$this->assertEqual($this->Formatacao->moeda(10.12), 'R$ 10,12');
	}

/**
 * testMoedaPorExtenso
 *
 * @retun void
 * @access public
 */
	function testMoedaPorExtenso() {
		$this->assertEqual($this->Formatacao->moedaPorExtenso(0), 'zero');
		$this->assertEqual($this->Formatacao->moedaPorExtenso(0.52), 'cinquenta e dois centavos');
		$this->assertEqual($this->Formatacao->moedaPorExtenso(1), 'um real');
		$this->assertEqual($this->Formatacao->moedaPorExtenso(1.2), 'um real e vinte centavos');
		$this->assertEqual($this->Formatacao->moedaPorExtenso(10), 'dez reais');
		$this->assertEqual($this->Formatacao->moedaPorExtenso(15), 'quinze reais');
		$this->assertEqual($this->Formatacao->moedaPorExtenso(25), 'vinte e cinco reais');
		$this->assertEqual($this->Formatacao->moedaPorExtenso(40), 'quarenta reais');
		$this->assertEqual($this->Formatacao->moedaPorExtenso(100), 'cem reais');
		$this->assertEqual($this->Formatacao->moedaPorExtenso(105), 'cento e cinco reais');
		$this->assertEqual($this->Formatacao->moedaPorExtenso(120), 'cento e vinte reais');
		$this->assertEqual($this->Formatacao->moedaPorExtenso(210), 'duzentos e dez reais');
		$this->assertEqual($this->Formatacao->moedaPorExtenso(322), 'trezentos e vinte e dois reais');
		$this->assertEqual($this->Formatacao->moedaPorExtenso(1234), 'um mil duzentos e trinta e quatro reais');
		$this->assertEqual($this->Formatacao->moedaPorExtenso(100000), 'cem mil reais');
		$this->assertEqual($this->Formatacao->moedaPorExtenso(1000000), 'um milhão de reais');
		$this->assertEqual($this->Formatacao->moedaPorExtenso(1045763), 'um milhão, quarenta e cinco mil setecentos e sessenta e três reais');
	}
}
