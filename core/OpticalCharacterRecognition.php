<?php

namespace rqdev\packages\ComputerVisionAPI;

require_once(realpath(dirname(__FILE__)) . '\urlHelper.php');

class OpticalCharacterRecognition extends urlHelper {

    /** @var array|empty Lista de erros na requisição */
    private $error = [];

    /** @var mixed Resposta da requisição */
    private $response = NULL;

    /**
     * @var string Idioma que será buscado na imagem.
     */
    private $language = null;

    /**
     * @var bool Detectar orientação?
     */
    private $detectOrientation = true;

    public function __construct() {
        // Constantes
        require_once(realpath(dirname(__FILE__)) . "/settings.php");

        // Http Request
        require_once(realpath(dirname(__FILE__)) . "/RHandler.php");

        // Helper Base
        require_once(realpath(dirname(__FILE__)) . "/BaseHelper.php");

        // Helper específico
        require_once(realpath(dirname(__FILE__)) . "/OpticalCharacterRecognitionHelper.php");

        $this->setLanguage(CVA_OCR_LANGUAGE[0][1]);

        // Preparando configurações da URL
        $this->Prepare();

        // Selecionando Path da API
        $this->setSelectedPath(CVA_API_PATHS[0]);
    }

    public function getLanguage() {
        return (string) $this->language;
    }

    public function setLanguage(string $language) {
        $this->language = (string) $language;
        return $this;
    }

    public function getDetectOrientation() {
        return (bool) $this->detectOrientation;
    }

    public function setDetectOrientation(bool $detectOrientation) {
        $this->detectOrientation = (bool) $detectOrientation;
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
        return $this->getComputerVisionOpticalCharacterRecognition() .
                '?language=' . $this->getLanguage() .
                '&detectOrientation=' . strval($this->getDetectOrientation());
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
            $this->setResponse((new \rqdev\packages\ComputerVisionAPI\OpticalCharacterRecognition\Helper($handle::$response)));
            return true;
        }
    }

    /**
     * @return \rqdev\packages\ComputerVisionAPI\OpticalCharacterRecognition\Helper Resposta da requisição.
     */
    public function getResponse() {
        return $this->response;
    }

    /**
     * 
     * @param \rqdev\packages\ComputerVisionAPI\OpticalCharacterRecognition\Helper $response
     * @return $this
     */
    private function setResponse(\rqdev\packages\ComputerVisionAPI\OpticalCharacterRecognition\Helper $response) {
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
