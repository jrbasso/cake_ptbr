<?php
/**
 * Action gerada pelo template do Bake para Controller.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.actions
 * @since         CakePHP(tm) v 1.3
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
require_once dirname(dirname(__FILE__)) . DS . 'Inflexao.php';
?>

/**
 * <?php echo $admin ?>index method
 *
 * @return void
 */
	public function <?php echo $admin ?>index() {
		$this-><?php echo $currentModelName ?>->recursive = 0;
		$this->set('<?php echo $pluralName ?>', $this->paginate());
	}

/**
 * <?php echo $admin ?>view method
 *
 * @param string $id
 * @return void
 */
	public function <?php echo $admin ?>view($id = null) {
		$this-><?php echo $currentModelName; ?>->id = $id;
		if (!$this-><?php echo $currentModelName; ?>->exists()) {
			throw new NotFoundException(__('<?php echo Inflexao::acentos(ucfirst(strtolower($singularHumanName))); ?> inválido'));
		}
		$this->set('<?php echo $singularName; ?>', $this-><?php echo $currentModelName; ?>->read(null, $id));
	}

<?php $compact = array(); ?>
/**
 * <?php echo $admin ?>add method
 *
 * @return void
 */
	public function <?php echo $admin ?>add() {
		if ($this->request->is('post')) {
			$this-><?php echo $currentModelName; ?>->create();
			if ($this-><?php echo $currentModelName; ?>->save($this->request->data)) {
<?php if ($wannaUseSession): ?>
				$this->Session->setFlash(__('O <?php echo Inflexao::acentos(strtolower($singularHumanName)); ?> foi salvo.'));
				$this->redirect(array('action' => 'index'));
<?php else: ?>
				$this->flash(__('<?php echo Inflexao::acentos(ucfirst(strtolower($currentModelName))); ?> salvo.'), array('action' => 'index'));
<?php endif; ?>
			} else {
<?php if ($wannaUseSession): ?>
				$this->Session->setFlash(__('O <?php echo Inflexao::acentos(strtolower($singularHumanName)); ?> não pode ser salvo. Por favor, tente novamente.'));
<?php endif; ?>
			}
		}
<?php
	foreach (array('belongsTo', 'hasAndBelongsToMany') as $assoc):
		foreach ($modelObj->{$assoc} as $associationName => $relation):
			if (!empty($associationName)):
				$otherModelName = $this->_modelName($associationName);
				$otherPluralName = $this->_pluralName($associationName);
				echo "\t\t\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n";
				$compact[] = "'{$otherPluralName}'";
			endif;
		endforeach;
	endforeach;
	if (!empty($compact)):
		echo "\t\t\$this->set(compact(".join(', ', $compact)."));\n";
	endif;
?>
	}

<?php $compact = array(); ?>
/**
 * <?php echo $admin ?>edit method
 *
 * @param string $id
 * @return void
 */
	public function <?php echo $admin; ?>edit($id = null) {
		$this-><?php echo $currentModelName; ?>->id = $id;
		if (!$this-><?php echo $currentModelName; ?>->exists()) {
			throw new NotFoundException(__('<?php echo Inflexao::acentos(ucfirst(strtolower($singularHumanName))); ?> inválido.'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this-><?php echo $currentModelName; ?>->save($this->request->data)) {
<?php if ($wannaUseSession): ?>
				$this->Session->setFlash(__('O <?php echo Inflexao::acentos(strtolower($singularHumanName)); ?> foi salvo.'));
				$this->redirect(array('action' => 'index'));
<?php else: ?>
				$this->flash(__('O <?php echo Inflexao::acentos(strtolower($singularHumanName)); ?> foi salvo.'), array('action' => 'index'));
<?php endif; ?>
			} else {
<?php if ($wannaUseSession): ?>
				$this->Session->setFlash(__('O <?php echo Inflexao::acentos(strtolower($singularHumanName)); ?> não pode ser salvo. Por favor, tente novamente.'));
<?php endif; ?>
			}
		} else {
			$this->request->data = $this-><?php echo $currentModelName; ?>->read(null, $id);
		}
<?php
		foreach (array('belongsTo', 'hasAndBelongsToMany') as $assoc):
			foreach ($modelObj->{$assoc} as $associationName => $relation):
				if (!empty($associationName)):
					$otherModelName = $this->_modelName($associationName);
					$otherPluralName = $this->_pluralName($associationName);
					echo "\t\t\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n";
					$compact[] = "'{$otherPluralName}'";
				endif;
			endforeach;
		endforeach;
		if (!empty($compact)):
			echo "\t\t\$this->set(compact(".join(', ', $compact)."));\n";
		endif;
	?>
	}

/**
 * <?php echo $admin ?>delete method
 *
 * @param string $id
 * @return void
 */
	public function <?php echo $admin; ?>delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this-><?php echo $currentModelName; ?>->id = $id;
		if (!$this-><?php echo $currentModelName; ?>->exists()) {
			throw new NotFoundException(__('<?php echo Inflexao::acentos(strtolower($singularHumanName)); ?> inválido.'));
		}
		if ($this-><?php echo $currentModelName; ?>->delete()) {
<?php if ($wannaUseSession): ?>
			$this->Session->setFlash(__('<?php echo Inflexao::acentos(ucfirst(strtolower($singularHumanName))); ?> excluído.'));
			$this->redirect(array('action'=>'index'));
<?php else: ?>
			$this->flash(__('<?php echo Inflexao::acentos(ucfirst(strtolower($singularHumanName))); ?> excluído.'), array('action' => 'index'));
<?php endif; ?>
		}
<?php if ($wannaUseSession): ?>
		$this->Session->setFlash(__('<?php echo Inflexao::acentos(ucfirst(strtolower($singularHumanName))); ?> não pode ser excluído.'));
<?php else: ?>
		$this->flash(__('<?php echo Inflexao::acentos(ucfirst(strtolower($singularHumanName))); ?> não pode ser excluído.'), array('action' => 'index'));
<?php endif; ?>
		$this->redirect(array('action' => 'index'));
	}