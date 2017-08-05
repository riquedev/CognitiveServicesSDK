<?php

namespace rqdev\packages\EmotionDetectionAPI;

require_once(realpath(dirname(__FILE__)) . '\urlHelper.php');

class EmotionRecognition extends \rqdev\packages\ComputerVisionAPI\urlHelper {

    /** @var array|empty Lista de erros na requisição */
    public $error = [];

    /** @var mixed Resposta da requisição */
    public $response = NULL;

    public function __construct() {
        require_once(realpath(dirname(__FILE__)) . "/settings.php");
        require_once(realpath(dirname(__FILE__)) . "/Handle.php");
        require_once(realpath(dirname(__FILE__)) . "/BaseHelper.php");
        require_once(realpath(dirname(__FILE__)) . "/EmotionRecognitionHelper.php");

        // Preparando configurações da URL
        $this->Prepare();

        // Selecionando Path da API
        $this->setSelectedPath(CVA_API_PATHS[1]);
    }

    public function Send(string $imageUrl, bool $useMainHeader = true) {
        $endPoint = $this->getEmotionRecognition();
        $headers = [];

        if ($useMainHeader) {
            foreach ($this->getEmotionRecognitionHeader1() as $key => $value) {
                $headers[] = $key . ":" . $value;
            }
        } else {
            foreach ($this->getEmotionRecognitionHeader2() as $key => $value) {
                $headers[] = $key . ":" . $value;
            }
        }

        $handle = new \rqdev\packages\ComputerVisionAPI\Handle($endPoint, $imageUrl, $headers);

        if (!$handle::$error) {
            $this->error = $handle::$error;
            return false;
        } else {
            $this->response = (new \rqdev\packages\EmotionDetectionAPI\EmotionRecognition\Helper($handle::$response));
            return true;
        }
    }

}
