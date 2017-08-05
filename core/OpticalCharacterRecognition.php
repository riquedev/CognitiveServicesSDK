<?php

namespace rqdev\packages\ComputerVisionAPI;

require_once(realpath(dirname(__FILE__)) . '\urlHelper.php');

class OpticalCharacterRecognition extends urlHelper {

    /** @var array|empty Lista de erros na requisição */
    public $error = [];

    /** @var mixed Resposta da requisição */
    public $response = NULL;
    private $language = null;
    private $detectOrientation = true;

    public function __construct() {
        require_once(realpath(dirname(__FILE__)) . "/settings.php");
        require_once(realpath(dirname(__FILE__)) . "/Handle.php");
        require_once(realpath(dirname(__FILE__)) . "/BaseHelper.php");
        require_once(realpath(dirname(__FILE__)) . "/OpticalCharacterRecognitionHelper.php");
        $this->setLanguage(CVA_OCR_LANGUAGE[0][1]);

        // Preparando configurações da URL
        $this->Prepare();

        // Selecionando Path da API
        $this->setSelectedPath(CVA_API_PATHS[0]);
    }

    public function getLanguage() {
        return $this->language;
    }

    public function setLanguage(string $language) {
        $this->language = (string) $language;
        return $this;
    }

    public function getDetectOrientation() {
        return $this->detectOrientation;
    }

    public function setDetectOrientation(bool $detectOrientation) {
        $this->detectOrientation = (bool) $detectOrientation;
        return $this;
    }

    public function Send(string $imageUrl, bool $useMainHeader = true) {
        $endPoint = $this->getComputerVisionOpticalCharacterRecognition() .
                '?language=' . $this->getLanguage() .
                '&detectOrientation=' . strval($this->getDetectOrientation());


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

        $handle = new Handle($endPoint, $imageUrl, $headers);

        if (!$handle::$error) {
            $this->error = $handle::$error;
            return false;
        } else {
            $this->response = (new \rqdev\packages\ComputerVisionAPI\OpticalCharacterRecognition\Helper($handle::$response));
            return true;
        }
    }

}
