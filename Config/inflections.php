<?php
/**
 * Ajustes das inflections para português
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @author        Juan Basso <jrbasso@gmail.com>
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link          http://wiki.github.com/jrbasso/cake_ptbr/inflections
 */

// Alteração do inflector
$_uninflected = array('atlas', 'lapis', 'onibus', 'pires', 'virus', '.*x', 'status');
$_pluralIrregular = array(
	'abdomens' => 'abdomen',
	'alemao' => 'alemaes',
	'artesa' => 'artesaos',
	'as' => 'ases',
	'bencao' => 'bencaos',
	'cao' => 'caes',
	'campus' => 'campi',
	'capelao' => 'capelaes',
	'capitao' => 'capitaes',
	'chao' => 'chaos',
	'charlatao' => 'charlataes',
	'cidadao' => 'cidadaos',
	'consul' => 'consules',
	'cristao' => 'cristaos',
	'dificil' => 'dificeis',
	'email' => 'emails',
	'escrivao' => 'escrivaes',
	'fossel' => 'fosseis',
	'germens' => 'germen',
	'grao' => 'graos',
	'hifens' => 'hifen',
	'irmao' => 'irmaos',
	'liquens' => 'liquen',
	'mal' => 'males',
	'mao' => 'maos',
	'orfao' => 'orfaos',
	'pais' => 'paises',
	'pai' => 'pais',
	'pao' => 'paes',
	'perfil' => 'perfis',
	'projetil' => 'projeteis',
	'reptil' => 'repteis',
	'sacristao' => 'sacristaes',
	'sotao' => 'sotaos',
	'tabeliao' => 'tabeliaes'
);

Inflector::rules('singular', array(
	'rules' => array(
		'/^(.*)(oes|aes|aos)$/i' => '\1ao',
		'/^(.*)(a|e|o|u)is$/i' => '\1\2l',
		'/^(.*)e?is$/i' => '\1il',
		'/^(.*)(r|s|z)es$/i' => '\1\2',
		'/^(.*)ns$/i' => '\1m',
		'/^(.*)s$/i' => '\1',
	),
	'uninflected' => $_uninflected,
	'irregular' => array_flip($_pluralIrregular)
), true);

Inflector::rules('plural', array(
	'rules' => array(
		'/^(.*)ao$/i' => '\1oes',
		'/^(.*)(r|s|z)$/i' => '\1\2es',
		'/^(.*)(a|e|o|u)l$/i' => '\1\2is',
		'/^(.*)il$/i' => '\1is',
		'/^(.*)(m|n)$/i' => '\1ns',
		'/^(.*)$/i' => '\1s'
	),
	'uninflected' => $_uninflected,
	'irregular' => $_pluralIrregular
), true);

Inflector::rules('transliteration', array(
	'/À|Á|Â|Ã|Ä|Å/' => 'A',
	'/È|É|Ê|Ë/' => 'E',
	'/Ì|Í|Î|Ï/' => 'I',
	'/Ò|Ó|Ô|Õ|Ö|Ø/' => 'O',
	'/Ù|Ú|Û|Ü/' => 'U',
	'/Ç/' => 'C',
	'/Ð/' => 'D',
	'/Ñ/' => 'N',
	'/Š/' => 'S',
	'/Ý|Ÿ/' => 'Y',
	'/Ž/' => 'Z',
	'/Æ/' => 'AE',
	'/ß/'=> 'ss',
	'/Œ/' => 'OE',
	'/à|á|â|ã|ä|å|ª/' => 'a',
	'/è|é|ê|ë|&/' => 'e',
	'/ì|í|î|ï/' => 'i',
	'/ò|ó|ô|õ|ö|ø|º/' => 'o',
	'/ù|ú|û|ü/' => 'u',
	'/ç/' => 'c',
	'/ð/' => 'd',
	'/ñ/' => 'n',
	'/š/' => 's',
	'/ý|ÿ/' => 'y',
	'/ž/' => 'z',
	'/æ/' => 'ae',
	'/œ/' => 'oe',
	'/ƒ/' => 'f'
));

unset($_uninflected, $_pluralIrregular);
