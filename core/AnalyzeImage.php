<?php

namespace rqdev\packages\ComputerVisionAPI;

/**
 * Extraia informações acionáveis de imagens
 *  @author Henrique da Silva Santos < rique_dev@hotmail.com >
 *  @copyright (c) 2017, Henrique da Silva Santos
 *  @license https://opensource.org/licenses/MIT
 *  @version 1.0.5
 *  @link https://docs.microsoft.com/pt-br/azure/cognitive-services/computer-vision/home Documentação Oficial
 *  @package ComputerVisionAPI
 */
require_once(realpath(dirname(__FILE__)) . '\urlHelper.php');

class AnalyzeImage extends urlHelper {

    /** @var array|empty Características visuais */
    private $visualFeatures = [];

    /** @var array|empty Detalhes que deseja obter. */
    private $details = [];

    /** @var string|en Idioma do retorno */
    private $language = 'en';

    /** @var array|empty Lista de erros na requisição */
    private $error = [];

    /** @var mixed Resposta da requisição */
    private $response;

    /**
     *  Esta operação extrai um rico conjunto de recursos visuais com base no conteúdo da imagem. 
     * 
     *  @author Henrique da Silva Santos < rique_dev@hotmail.com >
     *  @copyright (c) 2017, Henrique da Silva Santos
     *  @license https://opensource.org/licenses/MIT
     *  @version 1.0.5
     *  @link https://westus.dev.cognitive.microsoft.com/docs/services/56f91f2d778daf23d8ec6739/operations/56f91f2e778daf14a499e1fa Documentação Oficial
     * 
     */
    public function __construct() {

// Constantes
        require_once(realpath(dirname(__FILE__)) . "/settings.php");

// Http Request
        require_once(realpath(dirname(__FILE__)) . "/RHandler.php");

// Helper Base
        require_once(realpath(dirname(__FILE__)) . "/BaseHelper.php");

// Helper específico
        require_once(realpath(dirname(__FILE__)) . "/AnalyzeImageHelper.php");

// Preparando configurações da URL
        $this->Prepare();

// Selecionando Path da API
        $this->setSelectedPath(CVA_API_PATHS[0]);
    }

    /**
     * Retorna a lista de características visuais desejadas durante o retorno.     
     * @return array
     */
    public function getVisualFeatures() {
        return $this->visualFeatures;
    }

    /**
     * Retorna a lista de detalhes desejados no retorno
     * @return array
     */
    public function getDetails() {
        return $this->details;
    }

    /**
     * Retorna a linguagem do retorno.
     * @return string
     */
    public function getLanguage() {
        return $this->language;
    }

    /**
     * Insere os detalhes desejados no retorno.
     * @param mixed $details Detalhes. ( encontrados em core\settings.php )
     * @return $this
     */
    public function setDetails(array $details) {
        $this->details = $details;
        return $this;
    }

    /**
     * Seleciona o idioma do retorno. 
     * @param string $language Ex.: en
     * @return $this
     */
    public function setLanguage(string $language) {
        $this->language = $language;
        return $this;
    }

    /**
     * Seleciona a lista de características visuais desejadas.
     * @param array $visualFeatures Características visuais. ( encontrados em core\settings.php )
     * @return $this
     */
    public function setVisualFeatures(array $visualFeatures) {
        $this->visualFeatures = $visualFeatures;
        return $this;
    }

    /**
     * 
     * @return string Endpoint contruido.
     */
    protected function buildEndpoint() {
        // Formando Endpoint
        $endPoint = $this->getComputerVisionAnalyzeImage() .
                '?details=' . implode(",", $this->details) .
                "&visualFeatures=" . implode(",", $this->visualFeatures);

        $endPoint .= "&language=" . $this->language;

        return $endPoint;
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
            $this->setResponse((new AnalyzeImage\Helper($handle::$response)));
            return true;
        }
    }

    /**
     * Faz a requisição ao servidor.
     * @param string $imageUrl Link da imagem que será analisada.
     * @param boolean $useMainHeader Usar a Header principal
     * @return boolean Sucesso
     */
    public function Send(string $imageUrl, bool $useMainHeader = true) {
        $endPoint = $this->buildEndpoint();

        $headers = $this->buildHeaders($useMainHeader);

        $handle = new \rqdev\packages\tools\Handle();

        $handle::Post($endPoint, $headers, json_encode(['url' => $imageUrl]));

        // True = Ok
        return $this->checkErrors($handle);
    }

    /**
     * @return \rqdev\packages\ComputerVisionAPI\AnalyzeImage\Helper Resposta da requisição.
     */
    public function getResponse() {
        return $this->response;
    }

    /**
     * 
     * @param \rqdev\packages\ComputerVisionAPI\AnalyzeImage\Helper $response
     * @return $this
     */
    private function setResponse(\rqdev\packages\ComputerVisionAPI\AnalyzeImage\Helper $response) {
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
