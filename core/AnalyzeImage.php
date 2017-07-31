<?php

namespace rqdev\packages\ComputerVisionAPI;

class AnalyzeImage {

    private $visualFeatures = [];
    private $details = [];
    private $language = 'en';
    public $error = [];
    public $response = null;

    public function __construct() {
        require_once(realpath(dirname(__FILE__)) . "/settings.php");
        require_once(realpath(dirname(__FILE__)) . "/Handle.php");
    }

    public function getVisualFeatures() {
        return $this->visualFeatures;
    }

    public function getDetails() {
        return $this->details;
    }

    public function getLanguage() {
        return $this->language;
    }

    public function setDetails($details) {
        $this->details = $details;
        return $this;
    }

    public function setLanguage($language) {
        $this->language = $language;
        return $this;
    }

    public function setVisualFeatures(array $visualFeatures) {
        $this->visualFeatures = $visualFeatures;
        return $this;
    }

    public function Send(string $imageUrl) {
        $endPoint = CVA_COMPUTERVISION_ANALYZEIMAGE . '?details=' . implode(",", $this->details) . "&visualFeatures=" . implode(",", $this->visualFeatures);
        $endPoint .= "&language=" . $this->language;
        $headers = [];

        foreach (CVA_HEADERS_COMPUTERVISION1 as $key => $value) {
            $headers[] = $key . ":" . $value;
        }

        $handle = new Handle($endPoint, $imageUrl, $headers);

        if (!$handle::$error) {
            $this->error = $handle::$error;
            return false;
        } else {
            $this->response = $handle::$response;
            return true;
        }
    }

}
