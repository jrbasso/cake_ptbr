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

use Cake\Utility\Inflector;

// Alteração do inflector

Inflector::rules('singular', [
    '/^(.*)(oes|aes|aos)$/i' => '\1ao',
    '/^(.*)(a|e|o|u)is$/i' => '\1\2l',
    '/^(.*)e?is$/i' => '\1il',
    '/^(.*)(r|s|z)es$/i' => '\1\2',
    '/^(.*)ns$/i' => '\1m',
    '/^(.*)s$/i' => '\1',
]);

Inflector::rules('plural', [
    '/^(.*)ao$/i' => '\1oes',
    '/^(.*)(r|s|z)$/i' => '\1\2es',
    '/^(.*)(a|e|o|u)l$/i' => '\1\2is',
    '/^(.*)il$/i' => '\1is',
    '/^(.*)(m|n)$/i' => '\1ns',
    '/^(.*)$/i' => '\1s'
]);

Inflector::rules('uninflected', [
    'atlas',
    'lapis',
    'onibus',
    'pires',
    'virus',
    '.*x',
    'status'
]);

Inflector::rules('irregular', [
    'abdomen' => 'abdomens',
    'alcool' => 'alcoois',
    'alemao' => 'alemaes',
    'artesa' => 'artesaos',
    'as' => 'ases',
    'bencao' => 'bencaos',
    'campus' => 'campi',
    'cao' => 'caes',
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
    'gas' => 'gases',
    'germens' => 'germen',
    'grao' => 'graos',
    'hifens' => 'hifen',
    'irmao' => 'irmaos',
    'lei' => 'leis',
    'liquens' => 'liquen',
    'mal' => 'males',
    'mao' => 'maos',
    'orfao' => 'orfaos',
    'pai' => 'pais',
    'pais' => 'paises',
    'pao' => 'paes',
    'projetil' => 'projeteis',
    'reptil' => 'repteis',
    'sacristao' => 'sacristaes',
    'sotao' => 'sotaos',
    'tabeliao' => 'tabeliaes',
]);

Inflector::rules('transliteration', [
    'À' => 'A',
    'Á' => 'A',
    'Â' => 'A',
    'Ã' => 'A',
    'Ä' => 'A',
    'Å' => 'A',
    'È' => 'E',
    'É' => 'E',
    'Ê' => 'E',
    'Ë' => 'E',
    'Ì' => 'I',
    'Í' => 'I',
    'Î' => 'I',
    'Ï' => 'I',
    'Ò' => 'O',
    'Ó' => 'O',
    'Ô' => 'O',
    'Õ' => 'O',
    'Ö' => 'O',
    'Ø' => 'O',
    'Ù' => 'U',
    'Ú' => 'U',
    'Û' => 'U',
    'Ü' => 'U',
    'Ç' => 'C',
    'Ð' => 'D',
    'Ñ' => 'N',
    'Š' => 'S',
    'Ý' => 'Y',
    'Ÿ' => 'Y',
    'Ž' => 'Z',
    'Æ' => 'AE',
    'ß' => 'ss',
    'Œ' => 'OE',
    'à' => 'a',
    'á' => 'a',
    'â' => 'a',
    'ã' => 'a',
    'ä' => 'a',
    'å' => 'a',
    'ª' => 'a',
    'è' => 'e',
    'é' => 'e',
    'ê' => 'e',
    'ë' => 'e',
    '&' => 'e',
    'ì' => 'i',
    'í' => 'i',
    'î' => 'i',
    'ï' => 'i',
    'ò' => 'o',
    'ó' => 'o',
    'ô' => 'o',
    'õ' => 'o',
    'ö' => 'o',
    'ø' => 'o',
    'º' => 'o',
    'ù' => 'u',
    'ú' => 'u',
    'û' => 'u',
    'ü' => 'u',
    'ç' => 'c',
    'ð' => 'd',
    'ñ' => 'n',
    'š' => 's',
    'ý' => 'y',
    'ÿ' => 'ÿ',
    'ž' => 'z',
    'æ' => 'ae',
    'œ' => 'oe',
    'ƒ' => 'f'
]);
