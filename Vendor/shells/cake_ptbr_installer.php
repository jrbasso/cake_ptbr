<?php
/**
 * Instalador do plugin CakePtbr com PluginManager
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @author        Juan Basso <jrbasso@gmail.com>
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

if (App::import('Vendor', 'PluginManager.Installer')) {
/**
 * CakePtbrInstaller
 *
 */
	class CakePtbrInstaller extends InstallerPM {
/**
 * Instala a aplicação
 *
 * @return void
 * @access public
 */
		function install() {
			App::import('Core', 'File');
			$bootstrap = new File(CONFIGS . 'bootstrap.php');
			$conteudo = $bootstrap->read();
			// Caso o plugin já esteja instalado, ignora
			if (strpos('cake_ptbr', $conteudo) !== false) {
				return;
			}
			$conteudo = str_replace('?>', "require APP . 'plugins' . DS . 'cake_ptbr' . DS . 'config' . DS . 'bootstrap.php';\n?>", $conteudo);
			$bootstrap->write($conteudo);
			$bootstrap->close();
		}
	}
}

/**
 * CakePtbrInstaller Shell
 *
 */
class CakePtbrInstallerShell extends Shell {

/**
 * Main
 *
 * @return void
 * @access public
 */
	function main() {
		$this->out('Este arquivo eh reservado para instalacao atraves do PluginManager.');
		$this->out('Mais informacoes sobre o PluginManager: http://kiss.souagil.com.br/2009/04/plugin-manager/');
		$this->out('');
		$this->out('Desculpe o transtorno.');
	}
}
