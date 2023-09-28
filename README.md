<h1 align="center">Biblioteca para consumo de rotas da API do Banco do Brasil</h1>
<h3 align="center">O objetivo desse projeto é facilitar o consumo de rotas do sistema de pagamentos do Banco do Brasil.</h3>
<p align="center">
        <a href="https://github.com/filipeas/banco-do-brasil-bib-php/releases/tag/0.0.1" alt="Version">
            <img src="https://img.shields.io/badge/version-0.0.1-green" />
        </a>
</p>

# Dependências
- guzzlehttp/guzzle

# Como instalar
Antes de tudo, tenha certeza de ter instalado na sua máquina o [composer](https://getcomposer.org/).

Baixe esse repositório e acople dentro do seu projeto. Depois instale as dependências do projeto com o comando ``` composer install ```.

# Como usar
Abaixo segue um exemplo de como utilizar:

``` 
require_onde './vendor/autoload.php';

try {
    // instanciando API do Banco do Brasil
    $api = new API(1, $client_id, $client_secret, $api_key, $convenio);

    // exemplo de como consultar detalhes de um boleto usando o numero do boleto
    $api->getBoleto('NUMERO_DO_BOLETO');

    // exemplo de como consultar todos os boletos da conta
    $params = new ParamsListAllBoletos($api_key, 'B', '', $agencia, $conta, $wallet, $wallet_variation, '', '', '', '', '', '', '', $dataInicioRegistro, $dataFimRegistro, '', '', '', '', 1);
    $api->listAllBoletos($params);
} catch () {}
```

# Observações
- Atente-se a consultar a documentação da API do Banco do Brasil e pegar todas as variáveis de autenticação (essas variáveis você vai achar dentro da sua conta do Banco do Brasil).

# Dúvidas ou Sugestões?
Abra uma issue em caso de dúvidas ou sugestões de melhorias!