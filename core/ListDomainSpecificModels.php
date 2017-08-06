<?php

namespace rqdev\packages\ComputerVisionAPI;

require_once(realpath(dirname(__FILE__)) . '\urlHelper.php');

/**
 *  Esta classe tem o objetivo de trabalhar com a leitura de imagens feita pela
 *  api.
 * 
 *  @author Henrique da Silva Santos < rique_dev@hotmail.com >
 *  @copyright (c) 2017, Henrique da Silva Santos
 *  @license https://opensource.org/licenses/MIT
 *  @version 1.0.5
 *  @package \rqdev\packages\ComputerVisionAPI
 * 
 */
class ListDomainSpecificModels extends urlHelper {

    /** @var array|empty Lista de erros na requisição */
    public $error = [];

    /** @var mixed Resposta da requisição */
    public $response = NULL;

    public function __construct() {

        // Constantes
        require_once(realpath(dirname(__FILE__)) . "/settings.php");

        // Http Request
        require_once(realpath(dirname(__FILE__)) . "/RHandler.php");

        // Helper Base
        require_once(realpath(dirname(__FILE__)) . "/BaseHelper.php");

        // Helper específico
        require_once(realpath(dirname(__FILE__)) . "/ListDomainSpecificModelsHelper.php");

        // Preparando configurações da URL
        $this->Prepare();

        // Selecionando Path da API
        $this->setSelectedPath(CVA_API_PATHS[0]);
    }

    /**
     * Faz a requisição ao servidor.
     * @param boolean $useMainHeader Usar a Header principal
     * @return boolean Sucesso
     */
    public function Send(bool $useMainHeader = true) {
        $endPoint = $this->buildEndpoint();
        $headers = $this->buildHeaders($useMainHeader);

        $handle = new \rqdev\packages\tools\Handle();
        $handle::Get($endPoint, $headers);

        return $this->checkErrors($handle);
    }

    /**
     * 
     * @return string Endpoint contruido.
     */
    protected function buildEndpoint() {
        // Formando Endpoint
        return $this->getComputerVisionListModels();
    }

    /**
     * 
     * @param bool $useMainHeader Usar o header principal?
     * @return array Header montado.
     */
    protected function buildHeaders(bool $useMainHeader) {
        $headers = [];
        if ($useMainHeader) {
            foreach ($this->getComputerVisionHeader1() as $key => $value) {
                $headers[] = $key . ":" . $value;
            }
        } else {
            foreach ($this->getComputerVisionHeader2() as $key => $value) {
                $headers[] = $key . ":" . $value;
            }
        }

        return $headers;
    }

    /**
     * 
     * @param \rqdev\packages\tools\Handle $handle
     * @return boolean Requisição ocorreu com sucesso? 
     */
    protected function checkErrors(\rqdev\packages\tools\Handle $handle) {
        if (!$handle::$error) {
            $this->setError($handle::$error);
            return false;
        } else {
            // Helper Instanciado
            $this->setResponse((new \rqdev\packages\ComputerVisionAPI\ListDomainSpecificModels\Helper($handle::$response)));
            return true;
        }
    }

    /**
     * @return \rqdev\packages\ComputerVisionAPI\ListDomainSpecificModels\Helper Resposta da requisição.
     */
    public function getResponse() {
        return $this->response;
    }

    /**
     * 
     * @param \rqdev\packages\ComputerVisionAPI\ListDomainSpecificModels\Helper $response
     * @return $this
     */
    private function setResponse(\rqdev\packages\ComputerVisionAPI\ListDomainSpecificModels\Helper $response) {
        $this->response = $response;
        return $this;
    }

    /**
     * @return array Erros da requisição
     */
    public function getError() {
        return $this->error;
    }

    /**
     * @param mixed $error
     * @return $this
     */
    private function setError($error) {
        $this->error = $error;
        return $this;
    }

}
