<?php

namespace rqdev\packages\ComputerVisionAPI;

require_once(realpath(dirname(__FILE__)) . '\urlHelper.php');

/**
 *  Extraia informações acionáveis de imagens
 *  @author Henrique da Silva Santos < rique_dev@hotmail.com >
 *  @copyright (c) 2017, Henrique da Silva Santos
 *  @license https://opensource.org/licenses/MIT
 *  @version 1.0.5
 *  @link https://docs.microsoft.com/pt-br/azure/cognitive-services/computer-vision/home Documentação Oficial
 *  @package ComputerVisionAPI
 */
class DescribeImage extends urlHelper {

    /** @var string Máximo de descrições no retorno. */
    private $maxCandidates = "1";

    /** @var array|empty Lista de erros na requisição */
    private $error = [];

    /** @var mixed Resposta da requisição */
    private $response;

    /**
     *  Esta operação gera uma descrição de uma imagem em linguagem 
     *  legível para humanos com frases completas. 
     *  A descrição é baseada em uma coleção de tags de conteúdo,
     *  que também são devolvidos pela operação.
     *  Mais de uma descrição pode ser gerada para cada imagem.
     *  As descrições são ordenadas pelo seu índice de confiança.
     *  Todas as descrições estão em inglês. 
     * 
     *  @author Henrique da Silva Santos < rique_dev@hotmail.com >
     *  @copyright (c) 2017, Henrique da Silva Santos
     *  @license https://opensource.org/licenses/MIT
     *  @version 1.0.5
     *  @link https://westus.dev.cognitive.microsoft.com/docs/services/56f91f2d778daf23d8ec6739/operations/56f91f2e778daf14a499e1fe Documentação Oficial
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
        require_once(realpath(dirname(__FILE__)) . "/DescribeImageHelper.php");


        // Preparando configurações da URL
        $this->Prepare();

        // Selecionando Path da API
        $this->setSelectedPath(CVA_API_PATHS[0]);
    }

    /**
     * Retorna o total de descrições pedidas no retorno.
     * @return string
     */
    public function getMaxCandidates() {
        return $this->maxCandidates;
    }

    /**
     * Insere o máximo de descrições no retorno.
     * @param string $maxCandidates
     * @return $this
     */
    public function setMaxCandidates(string $maxCandidates) {
        $this->maxCandidates = $maxCandidates;
        return $this;
    }

    /**
     * Faz a requisição ao servidor.
     * @param string $imageUrl Link da imagem que será analisada.
     * @param boolean $useMainHeader Usar a Header principal
     * @return boolean Sucesso
     */
    public function Send(string $imageUrl, bool $useMainHeader = true) {

        // Formando Endpoint
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
        return $this->getComputerVisionDescribeImage() .
                '?maxCandidates=' . $this->getMaxCandidates();
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
            $this->setResponse((new \rqdev\packages\ComputerVisionAPI\DescribeImage\Helper($handle::$response)));
            return true;
        }
    }

    /**
     * @return \rqdev\packages\ComputerVisionAPI\DescribeImage\Helpe Resposta da requisição.
     */
    public function getResponse() {
        return $this->response;
    }

    /**
     * 
     * @param \rqdev\packages\ComputerVisionAPI\DescribeImage\Helpe $response
     * @return $this
     */
    private function setResponse(\rqdev\packages\ComputerVisionAPI\DescribeImage\Helper $response) {
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
