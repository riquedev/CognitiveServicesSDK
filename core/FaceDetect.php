<?php

namespace rqdev\packages\FaceAPI;

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
require_once(realpath(dirname(__FILE__)) . '\urlHelper.php');

class FaceDetect extends \rqdev\packages\ComputerVisionAPI\urlHelper {

    /** @var array|empty Lista de erros na requisição */
    public $error = [];

    /** @var mixed Resposta da requisição */
    public $response = null;
    private $returnFaceId;
    private $returnFaceLandmarks;
    private $returnFaceAttributes;

    public function __construct() {
        require_once(realpath(dirname(__FILE__)) . "/settings.php");
        require_once(realpath(dirname(__FILE__)) . "/Handle.php");
        require_once(realpath(dirname(__FILE__)) . "/BaseHelper.php");
        require_once(realpath(dirname(__FILE__)) . "/FaceDetectHelper.php");

        // Preparando configurações da URL
        $this->Prepare();

        // Selecionando Path da API
        $this->setSelectedPath(CVA_API_PATHS[2]);

        $this->setReturnFaceAttributes([]);
        $this->setReturnFaceId(false);
        $this->setReturnFaceLandmarks(false);
    }

    public function getReturnFaceId() {
        return $this->returnFaceId;
    }

    public function getReturnFaceLandmarks() {
        return $this->returnFaceLandmarks;
    }

    public function getReturnFaceAttributes() {
        return $this->returnFaceAttributes;
    }

    public function setReturnFaceId(bool $returnFaceId) {
        $this->returnFaceId = $returnFaceId;
        return $this;
    }

    public function setReturnFaceLandmarks(bool $returnFaceLandmarks) {
        $this->returnFaceLandmarks = $returnFaceLandmarks;
        return $this;
    }

    public function setReturnFaceAttributes(array $returnFaceAttributes) {
        $this->returnFaceAttributes = implode(',', $returnFaceAttributes);
        return $this;
    }

    public function Send(string $imageUrl, bool $useMainHeader = true) {
        $endPoint = $this->getFaceDetect() . '?returnFaceId=' .
                strval($this->getReturnFaceId()) . '&returnFaceLandmarks=' .
                strval($this->getReturnFaceLandmarks()) . '&returnFaceAttributes=' .
                strval($this->getReturnFaceAttributes());
        $headers = [];

        if ($useMainHeader) {
            foreach ($this->getFaceAPIHeader1() as $key => $value) {
                $headers[] = $key . ":" . $value;
            }
        } else {
            foreach ($this->getFaceAPIHeader2() as $key => $value) {
                $headers[] = $key . ":" . $value;
            }
        }

        $handle = new \rqdev\packages\ComputerVisionAPI\Handle($endPoint, $imageUrl, $headers);

        if (!$handle::$error) {
            $this->error = $handle::$error;
            return false;
        } else {
            $this->response = (new \rqdev\rqdev\packages\FaceAPI\FaceDetect\Helper($handle::$response));
            return true;
        }
    }

}
