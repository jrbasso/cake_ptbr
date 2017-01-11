<?php
namespace CakePtbr\Test\Traits;

use Cake\TestSuite\TestCase;
use CakePtbr\Model\Behavior\CorreiosTrait;
use CakePtbr\Test\TestCase\Model\Behavior\CorreiosTraitImpl;

/**
 * Class CorreiosTraitTest
 *
 * @property CorreiosTraitImpl $Correios
 * @package CakePtbr\Test\Traits
 */
class CorreiosTraitTest extends TestCase
{
    /**
     * @var CorreiosTraitImpl $Correios
     */
    private $Correios;

    public function setUp()
    {
        parent::setUp();
        $this->Correios = new CorreiosTraitImpl();
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->Correios);
    }

    public function testValorFrete()
    {

        $dados = [
            "servico" => CorreiosTrait::$CORREIOS_SEDEX,
            "cepOrigem" => "88037100",
            "cepDestino" => "86020121",
            "peso" => 1.00,
            "maoPropria" => true,
            "valorDeclarado" => 20.00,
            "avisoRecebimento" => false,
            "formato" => CorreiosTrait::$ENCOMENDA_CAIXA,
            "comprimento" => 20.00,
            "altura" => 20.00,
            "largura" => 30.00
        ];

        $tamanhoInvalido = ['largura' => 10];
        $cepInvalido = ['cepOrigem' => '1000-00'];
        $pesoInvalido = ['peso' => 40];
        $pesoNegativo = ['peso' => -12];


        $this->assertEquals(CorreiosTrait::$ERRO_CORREIOS_PARAMETROS_INVALIDOS, $this->Correios->valorFrete(array_merge($dados, $tamanhoInvalido)));
        $this->assertEquals(CorreiosTrait::$ERRO_CORREIOS_PARAMETROS_INVALIDOS, $this->Correios->valorFrete(array_merge($dados, $cepInvalido)));
        $this->assertEquals(CorreiosTrait::$ERRO_CORREIOS_EXCESSO_PESO, $this->Correios->valorFrete(array_merge($dados, $pesoInvalido)));
        $this->assertEquals(CorreiosTrait::$ERRO_CORREIOS_PARAMETROS_INVALIDOS, $this->Correios->valorFrete(array_merge($dados, $pesoNegativo)));

        $correios = $this->Correios->valorFrete($dados);

        $this->assertEquals([
            'valorMaoPropria' => '0,00',
            'valorTarifaValorDeclarado' => '0,00',
            'valorFrete' => 39,
            'valorTotal' => '39,80',
            'entregaDomiciliar' => true,
            'entregaSabado' => true
        ], $correios);

    }

    public function testEndereco()
    {
        $retorno = $this->Correios->endereco("45810000");
        $this->assertEquals("Porto Seguro", $retorno['cidade']);
        $this->assertEquals("BA", $retorno['estado']);

        $retorno = $this->Correios->endereco("86020-121");
        $this->assertContains("fim", $retorno['complemento']);
        $this->assertEquals("Rua Pernambuco", $retorno['logradouro']);
        $this->assertEquals("Centro", $retorno['bairro']);
        $this->assertEquals("Londrina", $retorno['cidade']);
        $this->assertEquals("PR", $retorno['estado']);


        $retorno = $this->Correios->endereco("00000-121");
        $this->assertEquals(CorreiosTrait::$ERRO_POSTMON_CEP_INVALIDO, $retorno);
    }


}