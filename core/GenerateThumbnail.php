<?php

namespace rqdev\packages\ComputerVisionAPI;

require_once(realpath(dirname(__FILE__)) . '\urlHelper.php');

/**
 *  Esta classe tem o objetivo de auxiliar na manipulação do retorno
 *  da análise.
 * 
 *  @author Henrique da Silva Santos < rique_dev@hotmail.com >
 *  @copyright (c) 2017, Henrique da Silva Santos
 *  @license https://opensource.org/licenses/MIT
 *  @version 1.0.5
 * 
 */
class GenerateThumbnail extends urlHelper {

    /**
     * @var integer Largura da thumbnail
     */
    private $width = 0;

    /**
     * @var integer Altura da thumbnail
     */
    private $height = 0;

    /**
     * @var boolean Corte inteligente
     */
    private $smartCropping = false;

    /** @var array|empty Lista de erros na requisição */
    private $error = [];

    /** @var mixed Resposta da requisição */
    private $response = NULL;

    public function __construct() {

        // Constantes
        require_once(realpath(dirname(__FILE__)) . "/settings.php");

        // Http Request
        require_once(realpath(dirname(__FILE__)) . "/RHandler.php");

        // Helper Base
        require_once(realpath(dirname(__FILE__)) . "/BaseHelper.php");

        // Helper específico
        require_once(realpath(dirname(__FILE__)) . "/GenerateThumbnailHelper.php");

        // Preparando configurações da URL
        $this->Prepare();

        // Selecionando Path da API
        $this->setSelectedPath(CVA_API_PATHS[0]);
    }

    /**
     * @return integer Obtem largura da thumbnail a ser gerada.
     */
    public function getWidth() {
        return $this->width;
    }

    /**
     * @return integer Obtem altura da thumbnail a ser gerada.
     */
    public function getHeight() {
        return $this->height;
    }

    /**
     * @return boolean O corte inteligente será utilizado?
     */
    public function getSmartCropping() {
        return $this->smartCropping;
    }

    /**
     * @param int $width Define largura da thumbnail.
     * @return $this
     */
    public function setWidth(int $width) {
        $this->width = (int) $width;
        return $this;
    }

    /**
     * @param int $height Define altura da thumbnail.
     * @return $this
     */
    public function setHeight(int $height) {
        $this->height = (int) $height;
        return $this;
    }

    /**
     * @param bool $smartCropping Usa corte inteligente.
     * @return $this
     */
    public function setSmartCropping(bool $smartCropping) {
        $this->smartCropping = (bool) $smartCropping;
        return $this;
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

        return $this->checkErrors($handle);
    }

    /**
     * 
     * @return string Endpoint contruido.
     */
    protected function buildEndpoint() {
        // Formando Endpoint
        return $this->getComputerVisionGetThumbnail() . '?width=' .
                $this->getWidth() .
                '&height=' . $this->getHeight() .
                '&smartCropping=' . strval($this->getSmartCropping());
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
            $this->setResponse((new \rqdev\packages\ComputerVisionAPI\GenerateThumbnail\Helper($handle::$response)));
            return true;
        }
    }

    /**
     * @return \rqdev\packages\ComputerVisionAPI\GenerateThumbnail\HelperResposta da requisição.
     */
    public function getResponse() {
        return $this->response;
    }

    /**
     * 
     * @param \rqdev\packages\ComputerVisionAPI\GenerateThumbnail\Helper $response
     * @return $this
     */
    private function setResponse(\rqdev\packages\ComputerVisionAPI\GenerateThumbnail\Helper $response) {
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
