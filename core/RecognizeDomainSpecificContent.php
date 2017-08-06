<?php

namespace rqdev\packages\ComputerVisionAPI;

require_once(realpath(dirname(__FILE__)) . '\urlHelper.php');

class RecognizeDomainSpecificContent extends urlHelper {

    private $model;
    private $response = null;
    private $error = null;

    public function __construct() {

        // Constantes
        require_once(realpath(dirname(__FILE__)) . "/settings.php");

        // Http Request
        require_once(realpath(dirname(__FILE__)) . "/RHandler.php");

        // Helper Base
        require_once(realpath(dirname(__FILE__)) . "/BaseHelper.php");

        // Helper específico
        require_once(realpath(dirname(__FILE__)) . "/RecognizeDomainSpecificContentHelper.php");

        // Preparando configurações da URL
        $this->Prepare();

        // Selecionando Path da API
        $this->setSelectedPath(CVA_API_PATHS[0]);

        $this->setModel(CVA_RECOGNIZEDOMAINSPECIFICCONTENT_CELEBRITIES);
    }

    public function getModel() {
        return $this->model;
    }

    public function setModel(string $model) {
        $this->model = $model;
        return $this;
    }

    public function Send(string $imageUrl, bool $useMainHeader = true) {
        $endPoint = $this->buildEndpoint();

        $headers = $this->buildHeaders($useMainHeader);

        $handle = new \rqdev\packages\tools\Handle();
        $handle::Post($endPoint, $headers, json_encode(['url' => $imageUrl]));

        return $this->checkErrors($handle);
    }

    /**
     * 
     * @return string Endpoint contruido.
     */
    protected function buildEndpoint() {
        // Formando Endpoint
        return $this->getComputerVisionRecognizeDomainSpecificContent() .
                '/' . $this->getModel() . '/analyze';
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
            $this->setResponse((new \rqdev\packages\ComputerVisionAPI\RecognizeDomainSpecificContent\Helper($handle::$response)));
            return true;
        }
    }

    /**
     * @return \rqdev\packages\ComputerVisionAPI\RecognizeDomainSpecificContent\Helper Resposta da requisição.
     */
    public function getResponse() {
        return $this->response;
    }

    /**
     * 
     * @param \rqdev\packages\ComputerVisionAPI\RecognizeDomainSpecificContent\Helper $response
     * @return $this
     */
    private function setResponse(\rqdev\packages\ComputerVisionAPI\RecognizeDomainSpecificContent\Helper $response) {
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
