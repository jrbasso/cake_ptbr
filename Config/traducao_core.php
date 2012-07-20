<?php
/**
 * Alteração para as frases do core ficarem em português
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @author        Juan Basso <jrbasso@gmail.com>
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link          http://wiki.github.com/jrbasso/cake_ptbr/traduzir-as-mensagens-do-core
 */

// Definindo idioma da aplicação
Configure::write('Config.language', 'pt-br');

// Adicionando o caminho do locale
App::build(array('Locale' => array(CakePlugin::path('CakePtbr') . 'Locale' . DS)));
