<?php

namespace rqdev\packages\FaceAPI;

require_once(realpath(dirname(__FILE__)) . '\urlHelper.php');

/**
 *  Detectar, identificar, analisar, organizar e marcar rostos em fotos
 * 
 *  @author Henrique da Silva Santos < rique_dev@hotmail.com >
 *  @copyright (c) 2017, Henrique da Silva Santos
 *  @license https://opensource.org/licenses/MIT
 *  @version 1.0.5
 *  @package FaceAPI
 *  @link https://docs.microsoft.com/pt-br/azure/cognitive-services/face/overview Documentação Oficial
 * 
 */
class FaceDetect extends \rqdev\packages\ComputerVisionAPI\urlHelper {

    /** @var array|empty Lista de erros na requisição */
    private $error = [];

    /** @var mixed Resposta da requisição */
    private $response = null;

    /**
     * @var boolean Retornará ID das Faces?
     */
    private $returnFaceId;

    /**
     * @var boolean Retornará coordenadas das Faces?
     */
    private $returnFaceLandmarks;

    /**
     * @var array Atributos que serão retornados das Faces
     */
    private $returnFaceAttributes;

    /**
     *  Detectar rostos humanos em uma imagem e retornar locais de rosto e, 
     *  opcionalmente, com faceIds, marcos e atributos.
     * 
     *  @author Henrique da Silva Santos < rique_dev@hotmail.com >
     *  @copyright (c) 2017, Henrique da Silva Santos
     *  @license https://opensource.org/licenses/MIT
     *  @version 1.0.5
     *  @package FaceAPI
     *  @link https://westus.dev.cognitive.microsoft.com/docs/services/563879b61984550e40cbbe8d/operations/563879b61984550f30395236 Documentação Oficial
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
        require_once(realpath(dirname(__FILE__)) . "/FaceDetectHelper.php");

        // Preparando configurações da URL
        $this->Prepare();

        // Selecionando Path da API
        $this->setSelectedPath(CVA_API_PATHS[2]);

        // [ Default ]
        $this->setReturnFaceAttributes([]);
        $this->setReturnFaceId(false);
        $this->setReturnFaceLandmarks(false);
        // [ Default ]
    }

    /**
     * @return bool A requisição retornará a ID de cada face?
     */
    public function getReturnFaceId() {
        return $this->returnFaceId;
    }

    /**
     * @return bool A requisição retornará as coordenadas das Faces?
     */
    public function getReturnFaceLandmarks() {
        return $this->returnFaceLandmarks;
    }

    /**
     * @return array Atributos que serão retornados na requisição.
     */
    public function getReturnFaceAttributes() {
        return $this->returnFaceAttributes;
    }

    /**
     * @param bool $returnFaceId Retornar ID das Faces?
     * @return $this
     */
    public function setReturnFaceId(bool $returnFaceId) {
        $this->returnFaceId = $returnFaceId;
        return $this;
    }

    /**
     * 
     * @param bool $returnFaceLandmarks Retornar coordenadas das Faces?
     * @return $this
     */
    public function setReturnFaceLandmarks(bool $returnFaceLandmarks) {
        $this->returnFaceLandmarks = $returnFaceLandmarks;
        return $this;
    }

    /**
     * @param array $returnFaceAttributes Atributos que devem ser retornados.
     * @return $this
     */
    public function setReturnFaceAttributes(array $returnFaceAttributes) {
        $this->returnFaceAttributes = implode(',', $returnFaceAttributes);
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
        return $this->getFaceDetect() . '?returnFaceId=' .
                strval($this->getReturnFaceId()) . '&returnFaceLandmarks=' .
                strval($this->getReturnFaceLandmarks()) . '&returnFaceAttributes=' .
                strval($this->getReturnFaceAttributes());
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
            $this->setResponse((new \rqdev\rqdev\packages\FaceAPI\FaceDetect\Helper($handle::$response)));
            return true;
        }
    }

    /**
     * @return \rqdev\packages\FaceAPI\FaceDetect\Helper Resposta da requisição.
     */
    public function getResponse() {
        return $this->response;
    }

    /**
     * 
     * @param \rqdev\packages\FaceAPI\FaceDetect\Helper $response
     * @return $this
     */
    private function setResponse(\rqdev\packages\FaceAPI\FaceDetect\Helperr $response) {
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
