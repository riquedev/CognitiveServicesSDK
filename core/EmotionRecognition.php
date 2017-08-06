<?php

namespace rqdev\packages\EmotionDetectionAPI;

require_once(realpath(dirname(__FILE__)) . '\urlHelper.php');

/**
 *  Personalize experiências com o reconhecimento de emoções
 *  @author Henrique da Silva Santos < rique_dev@hotmail.com >
 *  @copyright (c) 2017, Henrique da Silva Santos
 *  @license https://opensource.org/licenses/MIT
 *  @version 1.0.5
 *  @link https://docs.microsoft.com/pt-br/azure/cognitive-services/emotion/home Documentação Oficial
 *  @package EmotionDetectionAPI
 */
class EmotionRecognition extends \rqdev\packages\ComputerVisionAPI\urlHelper {

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
        require_once(realpath(dirname(__FILE__)) . "/EmotionRecognitionHelper.php");

        // Preparando configurações da URL
        $this->Prepare();

        // Selecionando Path da API
        $this->setSelectedPath(CVA_API_PATHS[1]);
    }

    /**
     * Faz a requisição ao servidor.
     * @param string $imageUrl Link da imagem que será analisada.
     * @param boolean $useMainHeader Usar a Header principal
     * @return boolean Sucesso
     */
    public function Send(string $imageUrl, bool $useMainHeader = true) {

        // Endpoint sendo gerado...
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
        return $this->getEmotionRecognition();
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
            $this->setResponse((new \rqdev\packages\EmotionDetectionAPI\EmotionRecognition\Helper($handle::$response)));
            return true;
        }
    }

    /**
     * @return \rqdev\packages\EmotionDetectionAPI\EmotionRecognition\Helper Resposta da requisição.
     */
    public function getResponse() {
        return $this->response;
    }

    /**
     * 
     * @param \rqdev\packages\EmotionDetectionAPI\EmotionRecognition\Helper $response
     * @return $this
     */
    private function setResponse(\rqdev\packages\EmotionDetectionAPI\EmotionRecognition\Helper $response) {
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
