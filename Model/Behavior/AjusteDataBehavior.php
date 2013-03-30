<?php
/**
 * Behavior para ajustar o formato de data
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @author        Juan Basso <jrbasso@gmail.com>
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * AjusteDataBehavior
 *
 * @link http://wiki.github.com/jrbasso/cake_ptbr/behavior-ajustedata
 */
class AjusteDataBehavior extends ModelBehavior {

/**
 * Configuração dos campos
 *
 * @var array
 * @access public
 */
	public $campos;

/**
 * Setup
 *
 * @param object $model
 * @param array $config
 * @return void
 * @access public
 */
	public function setup(Model $model, $config = array()) {
		if (empty($config)) {
			// Caso n�o seja informado os campos, ele ir� buscar no schema
			$this->campos[$model->name] = $this->_buscaCamposDate($model);
		} elseif (!is_array($config)) {
			$this->campos[$model->name] = array($config);
		} else {
			$this->campos[$model->name] = $config;
		}
	}

/**
 * Before Validate
 *
 * @param object $model
 * @return boolean
 * @access public
 */
	public function beforeValidate(Model $model) {
		return $this->ajustarDatas($model);
	}

/**
 * Before Save
 *
 * @param object $model
 * @return boolean
 * @access public
 */
	public function beforeSave(Model $model) {
		return $this->ajustarDatas($model);
	}

/**
 * Corrigir as datas
 *
 * @param object $model
 * @return boolean
 * @access public
 */
	public function ajustarDatas(Model $model) {
		$data =& $model->data[$model->name];
		foreach ($this->campos[$model->name] as $campo) {
			if (isset($data[$campo])) {
				// DATA E HORA
				if(preg_match('/\d{1,2}\/\d{1,2}\/\d{2,4} \d{1,2}\:\d{1,2}/', $data[$campo])) {
					$novaData = explode(' ', $data[$campo]);
					list($dia, $mes, $ano) = explode('/', $novaData[0]);
					list($hora, $minuto, $segundo) = explode(':', $novaData[1]);
					if (strlen($ano) == 2) {
						if ($ano > 50) $ano += 1900;
						else $ano += 2000;
					}
					$data[$campo] = "$ano-$mes-$dia $hora:$minuto:$segundo";
				}
				// DATA
				elseif(preg_match('/\d{1,2}\/\d{1,2}\/\d{2,4}/', $data[$campo])) {
					list($dia, $mes, $ano) = explode('/', $data[$campo]);
					if (strlen($ano) == 2) {
						if ($ano > 50) $ano += 1900;
						else $ano += 2000;
					}
					$data[$campo] = "$ano-$mes-$dia";
				}
			}
		}
		return true;
	}

/**
 * Buscar campos de data nos dados da model
 *
 * @param object $model
 * @return array Lista dos campos
 * @access protected
 */
	public function _buscaCamposDate(Model &$model) {
		$schema = $model->schema();
		if (!is_array($schema)) {
			return array();
		}
		$saida = array();
		foreach ($schema as $campo => $infos) {
			if ($infos['type'] == 'date' && !in_array($campo, array('created', 'updated', 'modified'))) {
				$saida[] = $campo;
			}
		}
		return $saida;
	}
}
