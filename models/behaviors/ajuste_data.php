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
	var $campos;

/**
 * Setup
 *
 * @param object $model
 * @param array $config
 * @return void
 * @access public
 */
	function setup(&$model, $config = array()) {
		if (empty($config)) {
			// Caso não seja informado os campos, ele irá buscar no schema
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
	function beforeValidate(&$model) {
		return $this->ajustarDatas($model);
	}

/**
 * Before Save
 *
 * @param object $model
 * @return boolean
 * @access public
 */
	function beforeSave(&$model) {
		return $this->ajustarDatas($model);
	}

/**
 * Corrigir as datas
 *
 * @param object $model
 * @return boolean
 * @access public
 */
	function ajustarDatas(&$model) {
		$data =& $model->data[$model->name];
		foreach ($this->campos[$model->name] as $campo) {
			if (isset($data[$campo]) && preg_match('/\d{1,2}\/\d{1,2}\/\d{2,4}/', $data[$campo])) {
				list($dia, $mes, $ano) = explode('/', $data[$campo]);
				if (strlen($ano) == 2) {
					if ($ano > 50) {
						$ano += 1900;
					} else {
						$ano += 2000;
					}
				}
				$data[$campo] = "$ano-$mes-$dia";
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
	function _buscaCamposDate(&$model) {
		if (!is_array($model->_schema)) {
			return array();
		}
		$saida = array();
		foreach ($model->_schema as $campo => $infos) {
			if ($infos['type'] == 'date' && !in_array($campo, array('created', 'updated', 'modified'))) {
				$saida[] = $campo;
			}
		}
		return $saida;
	}
}
