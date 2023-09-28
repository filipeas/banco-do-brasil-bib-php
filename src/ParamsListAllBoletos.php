<?php

namespace BoletoBB\api;

class ParamsListAllBoletos
{
    private $gw_dev_app_key;
    private $indicadorSituacao;
    private $contaCaucao;
    private $agenciaBeneficiario;
    private $contaBeneficiario;
    private $carteiraConvenio;
    private $variacaoCarteiraConvenio;
    private $modalidadeCobranca;
    private $cnpjPagador;
    private $digitoCNPJPagador;
    private $cpfPagador;
    private $digitoCPFPagador;
    private $dataInicioVencimento;
    private $dataFimVencimento;
    private $dataInicioRegistro;
    private $dataFimRegistro;
    private $dataInicioMovimento;
    private $dataFimMovimento;
    private $codigoEstadoTituloCobranca;
    private $boletoVencido;
    private int $indice;

    /**
     * @param string gw_dev_app_key
     * @param string indicadorSituacao
     * @param string contaCaucao
     * @param string agenciaBeneficiario
     * @param string contaBeneficiario
     * @param string carteiraConvenio
     * @param string variacaoCarteiraConvenio
     * @param string modalidadeCobranca
     * @param string cnpjPagador
     * @param string digitoCNPJPagador
     * @param string cpfPagador
     * @param string digitoCPFPagador
     * @param string dataInicioVencimento
     * @param string dataFimVencimento
     * @param string dataInicioRegistro
     * @param string dataFimRegistro
     * @param string dataInicioMovimento
     * @param string dataFimMovimento
     * @param string codigoEstadoTituloCobranca
     * @param string boletoVencido
     * @param int indice
     */
    function __construct(
        string $gw_dev_app_key,
        string $indicadorSituacao,
        string $contaCaucao,
        string $agenciaBeneficiario,
        string $contaBeneficiario,
        string $carteiraConvenio,
        string $variacaoCarteiraConvenio,
        string $modalidadeCobranca,
        string $cnpjPagador,
        string $digitoCNPJPagador,
        string $cpfPagador,
        string $digitoCPFPagador,
        string $dataInicioVencimento,
        string $dataFimVencimento,
        string $dataInicioRegistro,
        string $dataFimRegistro,
        string $dataInicioMovimento,
        string $dataFimMovimento,
        string $codigoEstadoTituloCobranca,
        string $boletoVencido,
        int $indice
    ) {
        $this->gw_dev_app_key = $gw_dev_app_key;
        $this->indicadorSituacao = $indicadorSituacao;
        $this->contaCaucao = $contaCaucao;
        $this->agenciaBeneficiario = $agenciaBeneficiario;
        $this->contaBeneficiario = $contaBeneficiario;
        $this->carteiraConvenio = $carteiraConvenio;
        $this->variacaoCarteiraConvenio = $variacaoCarteiraConvenio;
        $this->modalidadeCobranca = $modalidadeCobranca;
        $this->cnpjPagador = $cnpjPagador;
        $this->digitoCNPJPagador = $digitoCNPJPagador;
        $this->cpfPagador = $cpfPagador;
        $this->digitoCPFPagador = $digitoCPFPagador;
        $this->dataInicioVencimento = $dataInicioVencimento;
        $this->dataFimVencimento = $dataFimVencimento;
        $this->dataInicioRegistro = $dataInicioRegistro;
        $this->dataFimRegistro = $dataFimRegistro;
        $this->dataInicioMovimento = $dataInicioMovimento;
        $this->dataFimMovimento = $dataFimMovimento;
        $this->codigoEstadoTituloCobranca = $codigoEstadoTituloCobranca;
        $this->boletoVencido = $boletoVencido;
        $this->indice = $indice;
    }

    public function getgw_dev_app_key(): string
    {
        return $this->gw_dev_app_key;
    }

    public function getindicadorSituacao(): string
    {
        return $this->indicadorSituacao;
    }

    public function getcontaCaucao(): string
    {
        return $this->contaCaucao;
    }

    public function getagenciaBeneficiario(): string
    {
        return $this->agenciaBeneficiario;
    }

    public function getcontaBeneficiario(): string
    {
        return $this->contaBeneficiario;
    }

    public function getcarteiraConvenio(): string
    {
        return $this->carteiraConvenio;
    }

    public function getvariacaoCarteiraConvenio(): string
    {
        return $this->variacaoCarteiraConvenio;
    }

    public function getmodalidadeCobranca(): string
    {
        return $this->modalidadeCobranca;
    }

    public function getcnpjPagador(): string
    {
        return $this->cnpjPagador;
    }

    public function getdigitoCNPJPagador(): string
    {
        return $this->digitoCNPJPagador;
    }

    public function getcpfPagador(): string
    {
        return $this->cpfPagador;
    }

    public function getdigitoCPFPagador(): string
    {
        return $this->digitoCPFPagador;
    }

    public function getdataInicioVencimento(): string
    {
        return $this->dataInicioVencimento;
    }

    public function getdataFimVencimento(): string
    {
        return $this->dataFimVencimento;
    }

    public function getdataInicioRegistro(): string
    {
        return $this->dataInicioRegistro;
    }

    public function getdataFimRegistro(): string
    {
        return $this->dataFimRegistro;
    }

    public function getdataInicioMovimento(): string
    {
        return $this->dataInicioMovimento;
    }

    public function getdataFimMovimento(): string
    {
        return $this->dataFimMovimento;
    }

    public function getcodigoEstadoTituloCobranca(): string
    {
        return $this->codigoEstadoTituloCobranca;
    }

    public function getboletoVencido(): string
    {
        return $this->boletoVencido;
    }

    public function setindice(int $indice)
    {
        $this->indice = $indice;
    }

    public function getindice(): string
    {
        return $this->indice;
    }
}
