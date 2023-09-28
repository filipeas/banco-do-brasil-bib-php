<?php

namespace BoletoBB\api;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class API
{
    private $endPoints;
    private $clientId;
    private $clientSecret;
    private $applicationKey;
    private $numeroConvenio;
    private $urls;
    private $urlToken;
    private $uriToken;
    private $uriCobranca;
    private $clientToken;
    private $clientCobranca;
    private $token;

    /**
     * @param endPoints REQUIRED (1 - Produção | 2 - Homologação) Parametro para constrolar se a API está em produção ou homologação.
     * @param clientId REQUIRED client_id da conta do banco do brasil
     * @param clientSecret REQUIRED cliente_secret da conta do banco do brasil
     * @param applicationKey REQUIRED application_key da conta do banco do brasil
     * @param numeroConvenio REQUIRED numero_convenio da conta do banco do brasil
     */
    function __construct(int $endPoints, string $clientId, string $clientSecret, string $applicationKey, string $numeroConvenio)
    {
        $this->endPoints = $endPoints;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->applicationKey = $applicationKey;
        $this->numeroConvenio = $numeroConvenio;

        $this->token = '';

        if ($this->endPoints === 1) {
            $this->urls = 'https://api.bb.com.br/cobrancas/v2';
            $this->urlToken = 'https://oauth.bb.com.br/oauth/token';

            $this->uriToken = 'https://oauth.bb.com.br/oauth/token';
            $this->uriCobranca = 'https://api.bb.com.br';
        } else {
            $this->urls = 'https://api.sandbox.bb.com.br/cobrancas/v2';
            $this->urlToken = 'https://oauth.sandbox.bb.com.br/oauth/token';

            $this->uriToken = 'https://oauth.sandbox.bb.com.br';
            $this->uriCobranca = 'https://api.sandbox.bb.com.br';
        }

        $this->clientToken = new Client([
            'base_uri' => $this->uriToken,
        ]);

        $this->clientCobranca = new Client([
            'base_uri' => $this->uriCobranca,
        ]);

        if ($this->token === '') {
            $this->generateToken();
        }
    }

    public function generateToken()
    {
        try {
            $response = $this->clientToken->request(
                'POST',
                '/oauth/token',
                [
                    'headers' => [
                        'Accept' => '*/*',
                        'Content-Type' => 'application/x-www-form-urlencoded',
                        'Authorization' => 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret) . ''
                    ],
                    'verify' => false,
                    'form_params' => [
                        'grant_type' => 'client_credentials',
                        'scope' => 'cobrancas.boletos-info cobrancas.boletos-requisicao'
                    ]
                ]
            );

            $retorno = json_decode($response->getBody()->getContents());
            if (isset($retorno->access_token)) {
                $this->token = $retorno->access_token;
            }

            return $this->token;
        } catch (\Exception $error) {
            return new Exception("Erro ao gerar token: {$error->getMessage()}");
        }
    }

    public function setToken(string $token)
    {
        $this->token = $token;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getBoleto(string $id)
    {
        try {
            $response = $this->clientCobranca->request(
                'GET',
                "/cobrancas/v2/boletos/{$id}",
                [
                    'headers' => [
                        'X-Developer-Application-Key' => $this->applicationKey,
                        'Authorization' => 'Bearer ' . $this->token . ''
                    ],
                    'verify' => false,
                    'query' => [
                        'numeroConvenio' => $this->numeroConvenio,
                    ],
                ]
            );

            $statusCode = $response->getStatusCode();
            $result = json_decode($response->getBody()->getContents());
            return ['status' => $statusCode, 'response' => $result];
        } catch (ClientException $error) {
            return ['status' => 200, 'message' => json_decode($error->getResponse()->getBody()->getContents())];
        } catch (\Exception $error) {
            return ['error' => "Erro ao buscar boleto: {$error->getMessage()}"];
        }
    }

    public function listAllBoletos(ParamsListAllBoletos $params)
    {
        try {
            $response = $this->clientCobranca->request(
                'GET',
                '/cobrancas/v2/boletos',
                [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Bearer ' . $this->token . ''
                    ],
                    'verify' => false,
                    'query' => [
                        'gw-dev-app-key' => $params->getgw_dev_app_key(),
                        'indicadorSituacao' => $params->getindicadorSituacao(),
                        'contaCaucao' => $params->getcontaCaucao(),
                        'agenciaBeneficiario' => $params->getagenciaBeneficiario(),
                        'contaBeneficiario' => $params->getcontaBeneficiario(),
                        'carteiraConvenio' => $params->getcarteiraConvenio(),
                        'variacaoCarteiraConvenio' => $params->getvariacaoCarteiraConvenio(),
                        'modalidadeCobranca' => $params->getmodalidadeCobranca(),
                        'cnpjPagador' => $params->getcnpjPagador(),
                        'digitoCNPJPagador' => $params->getdigitoCNPJPagador(),
                        'cpfPagador' => $params->getcpfPagador(),
                        'digitoCPFPagador' => $params->getdigitoCPFPagador(),
                        'dataInicioVencimento' => $params->getdataInicioVencimento(),
                        'dataFimVencimento' => $params->getdataFimVencimento(),
                        'dataInicioRegistro' => $params->getdataInicioRegistro(),
                        'dataFimRegistro' => $params->getdataFimRegistro(),
                        'dataInicioMovimento' => $params->getdataInicioMovimento(),
                        'dataFimMovimento' => $params->getdataFimMovimento(),
                        'codigoEstadoTituloCobranca' => $params->getcodigoEstadoTituloCobranca(),
                        'boletoVencido' => $params->getboletoVencido(),
                        'indice' => $params->getindice(),
                    ]
                ]
            );

            $statusCode = $response->getStatusCode();
            $result = json_decode($response->getBody()->getContents());
            
            // recurssão para buscar todos os boletos
            $boletos = $result->boletos;

            if ($result->indicadorContinuidade === 'S') {
                $params->setindice($result->proximoIndice);
                $nextRequest = $this->listAllBoletos($params);
                array_push($boletos, $nextRequest['message']->boletos);
                $result->boletos = $boletos;
                $result->indicadorContinuidade = $nextRequest['message']->indicadorContinuidade;
                $result->quantidadeRegistros += $nextRequest['message']->quantidadeRegistros;
                $result->proximoIndice = $nextRequest['message']->proximoIndice;
            }


            return ['status' => $statusCode, 'message' => $result];
        } catch (ClientException $error) {
            return ['status' => 200, 'message' => json_decode($error->getResponse()->getBody()->getContents())];
        } catch (\Exception $error) {
            return ['error' => "Erro ao buscar boleto: {$error->getMessage()}"];
        }
    }
}
