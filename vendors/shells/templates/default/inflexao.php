<?php
/**
 * Classe auxiliar para ajustar as palavras na geração dos templates
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @author        Juan Basso <jrbasso@gmail.com>
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * Inflexao
 *
 */
class Inflexao {

/**
 * Ajusta as palavras para por acentos
 *
 * @param string $palavra Palavra a ser modificada
 * @return string Palavra com acento
 * @access public
 */
	function acentos($palavra) {
		$espacamentos = array(' ', '_');
		foreach ($espacamentos as $espacamento) {
			if (strpos($palavra, $espacamento) !== false) {
				$palavra = explode($espacamento, $palavra);
				$saida = '';
				foreach ($palavra as $pedaco) {
					$saida .= Inflexao::acentos($pedaco) . $espacamento;
				}
				return rtrim($saida, $espacamento);
			}
		}
		if (preg_match('/(.*)cao$/', $palavra, $matches)) {
			return $matches[1] . 'ção';
		}
		if (preg_match('/(.*)ao(s)?$/', $palavra, $matches)) {
			return $matches[1] . 'ão' . (isset($matches[2]) ? $matches[2] : '');
		}
		if (preg_match('/(.*)coes$/', $palavra, $matches)) {
			return $matches[1] . 'ções';
		}
		if (preg_match('/(.*)oes$/', $palavra, $matches)) {
			return $matches[1] . 'ões';
		}
		if (preg_match('/(.*)aes$/', $palavra, $matches)) {
			return $matches[1] . 'ães';
		}
		return $palavra;
	}

}
