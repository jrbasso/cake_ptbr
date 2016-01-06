# CakePtbr - Faça seu CakePHP falar português

Caso você tenha dúvidas, elogios, reclamações, sugestões, etc., acesse o
"Grupo de discursão CakePHP-PT":http://groups.google.com/group/cakephp-pt e envie uma mensagem.

Este plugin foi desenvolvido para a versão 3.x do CakePHP.


## Primeiros passos

Antes de tentar usar qualquer funcionalidade do Plugin, certifique-se que o plugin foi carregado no seu
arquivo ```config/bootstrap.php``` da seguinte maneira:

```php
<?php
    Plugin::load('CakePtbr', ['bootstrap'=> true]);
```

ou se o seu arquivo ```bootstrap.php``` possuir o ```Plugin::loadAll()``` pode ignorar este passo.


## Tradução das mensagens do core para pt_BR

Para traduzir as mensagens do core, copie ou faça um link simbólico do 
arquivo [src/Locale/pt_BR/cake.po](../src/Locale/pt_BR/cake.po) para sua 
pasta ```src/Locale/pt_BR```.



## Behaviors e Traits

Este repositório ainda conta com os seguintes behaviors/traits:

* [AjusteDataBehavior](behaviors/ajuste_data.md): Ajusta as datas que estão em formato brasileiro (dd/MM/AAAA) 
para formato SQL (AAAA-MM-dd) antes de salvar a entidade no banco de dados.

* [AjusteFloatBehavior](behaviors/ajuste_float.md): Ajusta os campos float que estão na representação númerica 
brasileira (1.000,00) para formato SQL (1000.00) antes de salvar.

* [CorreiosTrait](behaviors/correios_trait.md): Possui métodos para cálculo de prazo e preço de encomendas e 
para descoberta de endereços através de CEP.