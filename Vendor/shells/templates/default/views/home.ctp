<?php
$output = "<h2>\"" . Inflector::humanize($app) . "\" gerado pelo Bake do CakePHP!</h2>\n";
$output .="
<?php
if (Configure::read() > 0):
	Debugger::checkSecurityKeys();
endif;
?>
<p>
<?php
	if (is_writable(TMP)):
		echo '<span class=\"notice success\">';
			__('Seu diretório tmp está habilitado para escrita.');
		echo '</span>';
	else:
		echo '<span class=\"notice\">';
			__('Seu diretório tmp NÃO está habilitado para escrita.');
		echo '</span>';
	endif;
?>
</p>
<p>
<?php
	\$settings = Cache::settings();
	if (!empty(\$settings)):
		echo '<span class=\"notice success\">';
				printf(__('O %s está sendo usado para cache. Para alterar, edite o arquivo APP/config/core.php.', true), '<em>'. \$settings['engine'] . 'Engine</em>');
		echo '</span>';
	else:
		echo '<span class=\"notice\">';
				__('Seu cache NÃO está funcionando. Por favor, verifique suas configurações em APP/config/core.php.');
		echo '</span>';
	endif;
?>
</p>
<p>
<?php
	\$filePresent = null;
	if (file_exists(CONFIGS . 'database.php')):
		echo '<span class=\"notice success\">';
			__('Seu arquivo de configuração do banco de dados está presente.');
			\$filePresent = true;
		echo '</span>';
	else:
		echo '<span class=\"notice\">';
			__('Seu arquivo de configuração do banco de dados NÃO está presente.');
			echo '<br/>';
			__('Renomeie o arquivo config/database.php.default para config/database.php');
		echo '</span>';
	endif;
?>
</p>
<?php
if (!empty(\$filePresent)):
	if (!class_exists('ConnectionManager')) {
		require LIBS . 'model' . DS . 'connection_manager.php';
	}
	\$db = ConnectionManager::getInstance();
 	\$connected = \$db->getDataSource('default');
?>
<p>
<?php
	if (\$connected->isConnected()):
		echo '<span class=\"notice success\">';
 			__('Cake está apto para conectar no banco de dados.');
		echo '</span>';
	else:
		echo '<span class=\"notice\">';
			__('Cake NÃO está apto para conectar no banco de dados.');
		echo '</span>';
	endif;
?>
</p>\n";
$output .= "<?php endif;?>\n";
$output .= "<h3><?php __('Editando esta página') ?></h3>\n";
$output .= "<p>\n";
$output .= "<?php\n";
$output .= "\tprintf(__('Para alterar o conteúdo desta página, edite: %s\n";
$output .= "\t\tPara alterar o layout, edite: %s\n";
$output .= "\t\tVocê também pode adicionar alguns estilos de CSS para suas páginas em: %s', true),\n";
$output .= "\t\tAPP . 'views' . DS . 'pages' . DS . 'home.ctp.<br />',  APP . 'views' . DS . 'layouts' . DS . 'default.ctp.<br />', APP . 'webroot' . DS . 'css');\n";
$output .= "?>\n";
$output .= "</p>\n";
?>