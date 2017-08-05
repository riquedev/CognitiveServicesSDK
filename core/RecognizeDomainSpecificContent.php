<?php

namespace rqdev\packages\ComputerVisionAPI;

require_once(realpath(dirname(__FILE__)) . '\urlHelper.php');

class RecognizeDomainSpecificContent extends urlHelper {

    private $model;

    public function __construct() {
        require_once(realpath(dirname(__FILE__)) . "/settings.php");
        require_once(realpath(dirname(__FILE__)) . "/Handle.php");
        require_once(realpath(dirname(__FILE__)) . "/BaseHelper.php");
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
        $endPoint = $this->getComputerVisionRecognizeDomainSpecificContent() .
                '/' . $this->getModel() . '/analyze';

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
            $this->response = (new RecognizeDomainSpecificContent\Helper($handle::$response));
            return true;
        }
    }

}
