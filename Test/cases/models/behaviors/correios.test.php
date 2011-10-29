<?php
/**
 * Teste do behavior dos Correios
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @author        Juan Basso <jrbasso@gmail.com>
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

App::import('Core', 'Model');
App::import('Behavior', 'CakePtbr.Correios');

Mock::generatePartial(
	'CorreiosBehavior', 'MockCorreiosBehavior',
	array('_requisitaUrl')
);

/**
 * CakePtbr
 *
 */
class CakePtbr extends Model {

/**
 * Nome da model
 *
 * @var string
 * @access public
 */
	var $name = 'CakePtbr';

/**
 * Usar tabela?
 *
 * @var boolean
 * @access public
 */
	var $useTable = false;

/**
 * Lista de Behaviors
 *
 * @var array
 * @access public
 */
	var $actsAs = array('CakePtbr.Correios');
}

/**
 * Correios Test Case
 *
 */
class CakePtbrCorreiosCase extends CakeTestCase {

/**
 * Correios
 *
 * @var object
 * @access public
 */
	var $Correios = null;

/**
 * setUp
 *
 * @retun void
 * @access public
 */
	function setUp() {
		parent::setUp();
		$this->Correios = new MockCorreiosBehavior();
	}

/**
 * testValorFrete
 *
 * @retun void
 * @access public
 */
	function testValorFrete() {
		$model = null;

		$this->Correios->setReturnValueAt(0, '_requisitaUrl', ERRO_CORREIOS_FALHA_COMUNICACAO);
		$this->assertNotEqual($this->Correios->valorFrete($model, CORREIOS_SEDEX, '88000-000', '88888-000', 10), ERRO_CORREIOS_PARAMETROS_INVALIDOS);
		$this->assertEqual($this->Correios->valorFrete($model, 40000, '88000-000', '88888-000', 10), ERRO_CORREIOS_PARAMETROS_INVALIDOS);
		$this->assertEqual($this->Correios->valorFrete($model, CORREIOS_SEDEX, '88000-000', '88888-000', 'peso'), ERRO_CORREIOS_PARAMETROS_INVALIDOS);
		$this->assertEqual($this->Correios->valorFrete($model, CORREIOS_SEDEX, '88000-000', '88888-000', -12), ERRO_CORREIOS_PARAMETROS_INVALIDOS);
		$this->assertEqual($this->Correios->valorFrete($model, CORREIOS_SEDEX, '88000-000', '88888-000', 10, true, -10), ERRO_CORREIOS_PARAMETROS_INVALIDOS);
		$this->assertEqual($this->Correios->valorFrete($model, CORREIOS_SEDEX, '88000-000', '88888-000', 30.5), ERRO_CORREIOS_EXCESSO_PESO);

		$retorno = <<<EOF
<?xml version="1.0" encoding="ISO-8859-1" ?>
<calculo_precos>
<versao_arquivo>1.0</versao_arquivo>
<dados_postais>
<servico>40010</servico>
<servico_nome>SEDEX</servico_nome>
<uf_origem>SC</uf_origem>
<local_origem>Capital</local_origem>
<cep_origem>88037100</cep_origem>
<uf_destino>SC</uf_destino>
<local_destino>Capital</local_destino>
<cep_destino>88037100</cep_destino>
<peso>10</peso>
<mao_propria>3.5</mao_propria>
<aviso_recebimento>0</aviso_recebimento>
<valor_declarado>30</valor_declarado>
<tarifa_valor_declarado>0</tarifa_valor_declarado>
<preco_postal>26.9</preco_postal>
</dados_postais>
<erro>
<codigo>0</codigo>
<descricao></descricao>
</erro>
</calculo_precos>
EOF;
		$this->Correios->setReturnValueAt(1, '_requisitaUrl', $retorno);
		$correios = $this->Correios->valorFrete($model, CORREIOS_SEDEX, '88037-100', '88037-100', 10, true, 30, false);
		$correto = array(
			'ufOrigem' => 'SC',
			'ufDestino' => 'SC',
			'capitalOrigem' => true,
			'capitalDestino' => true,
			'valorMaoPropria' => 3.5,
			'valorTarifaValorDeclarado' => 0,
			'valorFrete' => 23.4,
			'valorTotal' => 26.9
		);
		$this->assertEqual($correios, $correto);
	}

/**
 * testEndereco
 *
 * @retun void
 * @access public
 */
	function testEndereco() {
		$retorno = <<<EOF
<!-- Aqui vem uma penca de código dos Correios, mas esta sendo suprimido pro teste -->
<table align="center" width="540" border="0" cellspacing="2" cellpadding="3">
<tr>
<td align="right">
<a href="/disquecoleta/pedido/default.cfm?cepOrigem=88037100" target="_blank"><img src="/encomendas/servicos/Sedex/Imagens/selo2_disque_coleta.gif" border="0"></a>
<a href="http://www.correios.com.br/enderecador/default.cfm" target="_blank"><img src="/encomendas/prazo/img/selo.gif" width="130" height="58" alt="" border="0"></a>
</td>
</tr>
<tr>
<td>
<img src="/encomendas/prazo/img/logo_sedex.gif" alt="" border="0">
</td>
</tr>
<tr>
<td height="24">
<table width="100%" border="0" cellspacing="2" cellpadding="0">
<tr bgcolor="#C4DEE9" class="titulo">
<td width="30%" height="20">&nbsp;</td>
<td width="35%" align="center" height="20"><b>Origem</b></td>
<td width="35%" align="center" height="20"><b>Destino</b></td>
</tr>
<tr class="tdAzul">
<td height="20">
<b>CEP:</b>
</td>
<td align="center">88037100</td>
<td align="center">88037100</td>
</tr>
<tr class="tdAmarelo" height="20">
<td>
<b>Endere&ccedil;o:</b>
</td>
<td align="center">Rua Acadêmico Reinaldo Consoni</td>
<td align="center">Rua Acadêmico Reinaldo Consoni</td>
</tr>
<tr class="tdAzul" height="20">
<td>
<b>Bairro:</b>
</td>
<td align="center">Santa Mônica</td>
<td align="center">Santa Mônica</td>
</tr>
<tr class="tdAmarelo">
<td height="20">
<b>Cidade/UF:</b>
</td>
<td align="center">Florianópolis/SC</td>
<td align="center">Florianópolis/SC</td>
</tr>
<tr class="tdAzul">
<td height="20">
<b>Prazo de Entrega:</b>
</td>
<td colspan="2" align="center">
<b>1 DIA &Uacute;TIL</b>&nbsp;&nbsp;
</td>
</tr>
<tr class="tdAmarelo">
<td height="20">
<b>Valor do Frete:</b>
</td>
<td colspan="2">
R$ 11,80
</td>
</tr>
<tr class="tdAzul">
<td>
<b>Servi&ccedil;os Opcionais</b>
</td>
<td colspan="2">
<font color="dcdcdc">Aviso de Recebimento</font><br>
<font color="dcdcdc"silver">M&atilde;o Pr&oacute;pria</font><br>
<font color="dcdcdc"e4e4e4">Valor Declarado</font><br>
Caixa Encomenda 01 (18x13,5x9 cm): R$ 2,00 
</td>
</tr>
<tr class="tdAmarelo">
<td height="20">
<b>Valor Total:</b>
</td>
<td colspan="2">
<b>R$ 13,80</b>
</td>
</tr>
<tr class="tdAzul">
<td colspan="3" height="20">
Localidade de origem com <b>DISQUE COLETA</b>. <a href="disquecoleta/pedido/default.cfm?cepOrigem=88037100" target="_blank">Clique aqui</a>  para solicitar a coleta de sua encomenda.
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td>
<b><a href="http://www.correios.com.br/encomendas/servicos/Sedex/sedex.cfm" target="_blank">Clique aqui</a></b> para saber mais sobre o SEDEX.
</td>
</tr>
<tr>
<td>
<p align="justify">
<font color="#ff0000">O pre&ccedil;o desta pesquisa &eacute; meramente informativo, devendo ser confirmado no ato da postagem</font>
</p>
</td>
</tr>
<tr valign="center">
<td align="center">
<input type="Button" value="Nova Consulta" class="cssBotao" onclick="JavaScript:history.back();">
</td>
</tr>
</table>
<!-- Aqui vem mais um monte de código, mas suprimido pro teste -->
EOF;
		$this->Correios->setReturnValueAt(0, '_requisitaUrl', utf8_decode($retorno));
		$correios = $this->Correios->endereco($model, '88037-100');
		$correto = array(
			'logradouro' => 'Rua Acadêmico Reinaldo Consoni',
			'bairro' => 'Santa Mônica',
			'cidade' => 'Florianópolis',
			'uf' => 'SC'
		);
		$this->assertEqual($correios, $correto);
	}

}
