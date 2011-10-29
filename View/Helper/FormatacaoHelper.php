<?php
/**
 * Helper para formatação de dados no padrão brasileiro
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @author        Juan Basso <jrbasso@gmail.com>
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * Formatação Helper
 *
 * @link http://wiki.github.com/jrbasso/cake_ptbr/helper-formatao
 */
class FormatacaoHelper extends AppHelper {

/**
 * Helpers auxiliares
 *
 * @var array
 * @access public
 */
	public $helpers = array('Time', 'Number');

/**
 * Formata a data
 *
 * @param integer $data Data em timestamp ou null para atual
 * @param array $opcoes É possível definir o valor de 'invalid' e 'userOffset' que serão usados pelo helper Time
 * @return string Data no formato dd/mm/aaaa
 * @access public
 */
	public function data($data = null, $opcoes = array()) {
		$padrao = array(
			'invalid' => '31/12/1969',
			'userOffset' => null
		);
		$config = array_merge($padrao, $opcoes);

		$data = $this->_ajustaDataHora($data);
		return $this->Time->format('d/m/Y', $data, $config['invalid'], $config['userOffset']);
	}

/**
 * Formata a data e hora
 *
 * @param integer $dataHora Data e hora em timestamp ou null para atual
 * @param boolean $segundos Mostrar os segundos
 * @param array $opcoes É possível definir o valor de 'invalid' e 'userOffset' que serão usados pelo helper Time
 * @return string Data no formato dd/mm/aaaa hh:mm:ss
 * @access public
 */
	public function dataHora($dataHora = null, $segundos = true, $opcoes = array()) {
		$padrao = array(
			'invalid' => '31/12/1969',
			'userOffset' => null
		);
		$config = array_merge($padrao, $opcoes);

		$dataHora = $this->_ajustaDataHora($dataHora);
		if ($segundos) {
			return $this->Time->format('d/m/Y H:i:s', $dataHora, $config['invalid'], $config['userOffset']);
		}
		return $this->Time->format('d/m/Y H:i', $dataHora, $config['invalid'], $config['userOffset']);
	}

/**
 * Mostrar a data completa
 *
 * @param integer $dataHora Data e hora em timestamp ou null para atual
 * @return string Descrição da data no estilo "Sexta-feira", 01 de Janeiro de 2010, 00:00:00"
 * @access public
 */
	public function dataCompleta($dataHora = null) {
		$_diasDaSemana = array('Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado');
		$_meses = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');

		$dataHora = $this->_ajustaDataHora($dataHora);
		$w = date('w', $dataHora);
		$n = date('n', $dataHora) - 1;

		return sprintf('%s, %02d de %s de %04d, %s', $_diasDaSemana[$w], date('d', $dataHora), $_meses[$n], date('Y', $dataHora), date('H:i:s', $dataHora));
	}

/**
 * Se a data for nula, usa data atual
 *
 * @param mixed $data
 * @return integer Se null, retorna a data/hora atual
 * @access protected
 */
	protected function _ajustaDataHora($data) {
		if (is_null($data)) {
			return time();
		}
		if (is_integer($data) || ctype_digit($data)) {
			return (int)$data;
		}
		return strtotime((string)$data);
	}

/**
 * Mostrar uma data em tempo
 *
 * @param integer $dataHora Data e hora em timestamp, dd/mm/YYYY ou null para atual
 * @param string $limite null, caso não haja expiração ou então, forneça um tempo usando o formato inglês para strtotime: Ex: 1 year
 * @return string Descrição da data em tempo ex.: a 1 minuto, a 1 semana
 * @access public
 */

	protected function tempo($dataHora = null, $limite = '30 days'){
		if (!$dataHora) {
			$dataHora = time();
		}

		if (strpos($dataHora, '/') !== false) {
			$_dataHora = str_replace('/', '-', $dataHora);
			$_dataHora = date('ymdHi', strtotime($_dataHora));
		} elseif (is_string($dataHora)) {
			$_dataHora = date('ymdHi', strtotime($dataHora));
		} else {
			$_dataHora = date('ymdHi', $dataHora);
		}

		if ($limite !== null) {
			if ($_dataHora > date('ymdHi', strtotime('+ ' . $limite))) {
				return $this->dataHora($dataHora);
			}
		}

		$_dataHora = date('ymdHi') - $_dataHora;
		if ($_dataHora > 88697640 && $_dataHora < 100000000) {
			$_dataHora -= 88697640;
		}

		switch ($_dataHora) {
			case 0:
				return 'menos de 1 minuto';
			case ($_dataHora < 99):
				if ($_dataHora === 1) {
					return '1 minuto';
				} elseif ($_dataHora > 59) {
					return ($_dataHora - 40) . ' minutos';
				}
				return $_dataHora . ' minutos';
			case ($_dataHora > 99 && $_dataHora < 2359):
				$flr = floor($_dataHora * 0.01);
				return $flr == 1 ? '1 hora' : $flr . ' horas';

			case ($_dataHora > 2359 && $_dataHora < 310000):
				$flr = floor($_dataHora * 0.0001);
				return $flr == 1 ? '1 dia' : $flr . ' dias';

			case ($_dataHora > 310001 && $_dataHora < 12320000):
				$flr = floor($_dataHora * 0.000001);
				return $flr == 1 ? '1 mes' : $flr . ' meses';

			case ($_dataHora > 100000000):
			default:
				$flr = floor($_dataHora * 0.00000001);
				return $flr == 1 ? '1 ano' : $flr . ' anos';

		}
	}


/**
 * Número float com ponto ao invés de vírgula
 *
 * @param float $numero Número
 * @param integer $casasDecimais Número de casas decimais
 * @return string Número formatado
 * @access public
 */
	public function precisao($numero, $casasDecimais = 3) {
		return number_format($numero, $casasDecimais, ',', '.');
	}

/**
 * Valor formatado com símbolo de %
 *
 * @param float $numero Número
 * @param integer $casasDecimais Número de casas decimais
 * @return string Número formatado com %
 * @access public
 */
	public function porcentagem($numero, $casasDecimais = 2) {
		return $this->precisao($numero, $casasDecimais) . '%';
	}

/**
 * Formata um valor para reais
 *
 * @param float $valor Valor
 * @param array $opcoes Mesmas opções de Number::currency()
 * @return string Valor formatado em reais
 * @access public
 */
	public function moeda($valor, $opcoes = array()) {
		$padrao = array(
			'before'=> 'R$ ',
			'after' => '',
			'zero' => 'R$ 0,00',
			'places' => 2,
			'thousands' => '.',
			'decimals' => ',',
			'negative' => '()',
			'escape' => true
		);
		$config = array_merge($padrao, $opcoes);
		if ($valor > -1 && $valor < 1) {
			$before = $config['before'];
			$config['before'] = '';
			$formatado = $this->Number->format(abs($valor), $config);
			if ($valor < 0 ) {
				if ($config['negative'] == '()') {
					return '(' . $before . $formatado .')';
				} else {
					return $before . $config['negative'] . $formatado;
				}
			}
			return $before . $formatado;
		}
		return $this->Number->currency($valor, null, $config);
	}

/**
 * Valor por extenso em reais
 *
 * @param float $numero
 * @return string Valor em reais por extenso
 * @access public
 * @link http://forum.imasters.uol.com.br/index.php?showtopic=125375
 */
	public function moedaPorExtenso($numero) {
		$singular = array('centavo', 'real', 'mil', 'milhão', 'bilhão', 'trilhão', 'quatrilhão');
		$plural = array('centavos', 'reais', 'mil', 'milhões', 'bilhões', 'trilhões', 'quatrilhões');

		$c = array('', 'cem', 'duzentos', 'trezentos', 'quatrocentos', 'quinhentos', 'seiscentos', 'setecentos', 'oitocentos', 'novecentos');
		$d = array('', 'dez', 'vinte', 'trinta', 'quarenta', 'cinquenta', 'sessenta', 'setenta', 'oitenta', 'noventa');
		$d10 = array('dez', 'onze', 'doze', 'treze', 'quatorze', 'quinze', 'dezesseis', 'dezesete', 'dezoito', 'dezenove');
		$u = array('', 'um', 'dois', 'três', 'quatro', 'cinco', 'seis', 'sete', 'oito', 'nove');

		$z = 0;
		$rt = '';

		$valor = number_format($numero, 2, '.', '.');
		$inteiro = explode('.', $valor);
		$tamInteiro = count($inteiro);

		// Normalizandos os valores para ficarem com 3 digitos
		$inteiro[0] = sprintf('%03d', $inteiro[0]);
		$inteiro[$tamInteiro - 1] = sprintf('%03d', $inteiro[$tamInteiro - 1]);

		$fim = $tamInteiro - 1;
		if ($inteiro[$tamInteiro - 1] <= 0) {
			$fim--;
		}
		foreach ($inteiro as $i => $valor) {
			$rc = $c[$valor{0}];
			if ($valor > 100 && $valor < 200) {
				$rc = 'cento';
			}
			$rd = '';
			if ($valor{1} > 1) {
				$rd = $d[$valor{1}];
			}
			$ru = '';
			if ($valor > 0) {
				if ($valor{1} == 1) {
					$ru = $d10[$valor{2}];
				} else {
					$ru = $u[$valor{2}];
				}
			}

			$r = $rc;
			if ($rc && ($rd || $ru)) {
				$r .= ' e ';
			}
			$r .= $rd;
			if ($rd && $ru) {
				$r .= ' e ';
			}
			$r .= $ru;
			$t = $tamInteiro - 1 - $i;
			if (!empty($r)) {
				$r .= ' ';
				if ($valor > 1) {
					$r .= $plural[$t];
				} else {
					$r .= $singular[$t];
				}
			}
			if ($valor == '000') {
				$z++;
			} elseif ($z > 0) {
				$z--;
			}
			if ($t == 1 && $z > 0 && $inteiro[0] > 0) {
				if ($z > 1) {
					$r .= ' de ';
				}
				$r .= $plural[$t];
			}
			if (!empty($r)) {
				if ($i > 0 && $i < $fim  && $inteiro[0] > 0 && $z < 1) {
					if ($i < $fim) {
						$rt .= ', ';
					} else {
						$rt .= ' e ';
					}
				} elseif ($t == 0 && $inteiro[0] > 0) {
					$rt .= ' e ';
				} else {
					$rt .= ' ';
				}
				$rt .= $r;
			}
		}

		if (empty($rt)) {
			return 'zero';
		}
		return trim(str_replace('  ', ' ', $rt));
	}

}
