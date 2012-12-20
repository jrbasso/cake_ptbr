<?php
/**
 * Behavior para ajustar os campos float
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @author        Juan Basso <jrbasso@gmail.com>
 * @author        Daniel Pakuschewski <contato@danielpk.com.br>
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * AjusteFloatBehavior
 *
 * @link http://wiki.github.com/jrbasso/cake_ptbr/behavior-ajustefloat
 */
class AjusteFloatBehavior extends ModelBehavior {

/**
 * Campos do tipo float
 *
 * @var array
 * @access public
 */
	public $floatFields = array();

/**
 * Setup
 *
 * @param Model $model
 * @param array $config
 * @return void
 * @access public
 */
	public function setup(Model $model, $config = array()) {
		$this->floatFields[$model->alias] = array();
		foreach ($model->schema() as $field => $spec) {
			if ($spec['type'] == 'float') {
				$this->floatFields[$model->alias][] = $field;
			}
		}
	}
	
/**
 * Before Find
 * Transforma o valor de BRL para o formato SQL antes de executar uma query
 * com conditions.
 * 
 * @param object $model
 * @return boolean
 * @access public
 */	
	public function beforeValidate(Model $model) {
		foreach($model->data[$model->alias] as $field => $value) {
			if ($model->hasField($field) && $model->_schema[$field]['type'] == 'float') {
				if (!is_string($value) || preg_match('/^[0-9]+(\.[0-9]+)?$/', $value)) {
					continue;
				}
				$model->data[$model->alias][$field] = str_replace(array('.', ','), array('', '.'), $value);
			}
		}
		return true;
	}
	
/**
 * Before Find
 * Transforma o valor de BRL para o formato SQL antes de executar uma query
 * com conditions.
 * 
 * @param object $model
 * @return array
 * @access public
 */
	public function beforeFind(Model $model, $query) {
		if (is_array($query['conditions'])) {
			foreach ($query['conditions'] as $field => $value) {
				if (strpos($field, '.') === false) {
					$field = $model->alias . '.' . $field;
				}
				list($modelName, $field) = explode('.', $field);
				$modelName = str_replace('`', '', $modelName);
				$useModel = ($modelName != $model->alias) ? $model->{$modelName} : $model;
				if ($useModel->hasField($field) && $useModel->_schema[$field]['type'] == 'float') {
					if (!is_string($value) || preg_match('/^[0-9]+(\.[0-9]+)?$/', $value)) {
						continue;
					}
					$value = str_replace(',', '.', str_replace('.', '', $value));
					if (isset($query['conditions'][$field])) {
						$query['conditions'][$field] = $value;
					}
					if (isset($query['conditions'][$useModel->alias . '.' . $field])) {
						$query['conditions'][$useModel->alias . '.' . $field] = $value;
					}
				}
			}
		}
		return $query;
	}

/**
 * Before Save
 *
 * @param object $model
 * @return void
 * @access public
 */
	public function beforeSave(Model $model) {
		$data =& $model->data[$model->alias];
		foreach ($data as $name => $value) {
			if (in_array($name, $this->floatFields[$model->alias])) {
				if (!is_string($value) || preg_match('/^[0-9]+(\.[0-9]+)?$/', $value)) {
					continue;
				}
				$data[$name] = str_replace(array('.', ','), array('', '.'), $value);
			}
		}

		return true;
	}

}
