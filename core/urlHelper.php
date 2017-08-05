<?php

namespace rqdev\packages\ComputerVisionAPI;

class urlHelper {

    private $HttpVersion;
    private $SSLVersion;
    private $APILocation;
    private $APILocationArray;
    private $APIAfterLocation;
    private $APIVersion;
    private $APIPaths;
    private $SelectedPath;
    private $APIComputerVisionKey1;
    private $APIComputerVisionKey2;
    private $APIEmotionDetectKey1;
    private $APIEmotionDetectKey2;
    private $APIResponseContent;
    private $APILanguage;
    private $APIMaxRedirections;
    private $APITimeout;

    protected function Prepare() {

        $this->HttpVersion = CVA_HTTP_VERSION;
        $this->SSLVersion = CVA_SSL_VERSION;
        $this->APILocation = CVA_API_LOCATION_ARRAY[0];
        $this->APILocationArray = CVA_API_LOCATION_ARRAY;
        $this->APIVersion = CVA_API_VERSION;
        $this->APIPaths = CVA_API_PATHS;
        $this->SelectedPath = $this->APIPaths[0];
        $this->APIAfterLocation = CVA_AFTER_LOCATION;
        $this->APIComputerVisionKey1 = CVA_KEY_COMPUTERVISION1;
        $this->APIComputerVisionKey2 = CVA_KEY_COMPUTERVISION2;
        $this->APIEmotionDetectKey1 = CVA_KEY_EMOTIONDETECT1;
        $this->APIEmotionDetectKey2 = CVA_KEY_EMOTIONDETECT2;
        $this->APIResponseContent = CVA_CONTENT;
        $this->APILanguage = CVA_LANGUAGE;
        $this->APIMaxRedirections = CVA_MAX_REDIRS;
        $this->APITimeout = CVA_TIMEOUT;
    }

    public function getHttpVersion() {
        return $this->HttpVersion;
    }

    public function getSSLVersion() {
        return $this->SSLVersion;
    }

    public function getAPILocation() {
        return $this->APILocation;
    }

    public function getAPILocationArray() {
        return $this->APILocationArray;
    }

    public function setHttpVersion($HttpVersion) {
        $this->HttpVersion = $HttpVersion;
        return $this;
    }

    public function setSSLVersion($SSLVersion) {
        $this->SSLVersion = $SSLVersion;
        return $this;
    }

    public function setAPILocation($APILocation) {
        $this->APILocation = $APILocation;
        return $this;
    }

    public function getAPIVersion() {
        return $this->APIVersion;
    }

    public function getAPIPaths() {
        return $this->APIPaths;
    }

    public function getSelectedPath() {
        return $this->SelectedPath;
    }

    public function setAPIVersion($APIVersion) {
        $this->APIVersion = $APIVersion;
        return $this;
    }

    public function setAPIPaths($APIPaths) {
        $this->APIPaths = $APIPaths;
        return $this;
    }

    public function setSelectedPath($SelectedPath) {
        $this->SelectedPath = $SelectedPath;
        return $this;
    }

    protected function getEndpoint() {
        return 'https://' . $this->APILocation . $this->APIAfterLocation .
                '/' . $this->SelectedPath . '/' . $this->APIVersion . '/';
    }

    public function getComputerVisionAnalyzeImage() {
        return $this->getEndpoint() . 'analyze';
    }

    public function getComputerVisionDescribeImage() {
        return $this->getEndpoint() . 'describe';
    }

    public function getComputerVisionTagImage() {
        return $this->getEndpoint() . 'tag';
    }

    public function getComputerVisionHandwrittenTextOperationResult() {
        return $this->getEndpoint() . 'textOperations';
    }

    public function getComputerVisionGetThumbnail() {
        return $this->getEndpoint() . 'generateThumbnail';
    }

    public function getComputerVisionListModels() {
        return $this->getEndpoint() . 'models';
    }

    public function getComputerVisionOpticalCharacterRecognition() {
        return $this->getEndpoint() . 'ocr';
    }

    public function getComputerVisionRecognizeDomainSpecificContent() {
        return $this->getEndpoint() . 'models';
    }

    public function getComputerVisionHeader1() {
        return array(
            'content-type' => $this->APIResponseContent,
            'ocp-apim-subscription-key' => $this->APIComputerVisionKey1,
            'accept-encoding' => 'gzip, deflate, br',
            'cache-control' => 'no-cache'
        );
    }

    public function getComputerVisionHeader2() {
        return array(
            'content-type' => $this->APIResponseContent,
            'ocp-apim-subscription-key' => $this->APIComputerVisionKey2,
            'accept-encoding' => 'gzip, deflate, br',
            'cache-control' => 'no-cache'
        );
    }

    public function getAPIAfterLocation() {
        return $this->APIAfterLocation;
    }

    public function getAPIComputerVisionKey1() {
        return $this->APIComputerVisionKey1;
    }

    public function getAPIComputerVisionKey2() {
        return $this->APIComputerVisionKey2;
    }

    public function getAPIEmotionDetectKey1() {
        return $this->APIEmotionDetectKey1;
    }

    public function getAPIEmotionDetectKey2() {
        return $this->APIEmotionDetectKey2;
    }

    public function getAPIResponseContent() {
        return $this->APIResponseContent;
    }

    public function getAPILanguage() {
        return $this->APILanguage;
    }

    public function getAPIMaxRedirections() {
        return $this->APIMaxRedirections;
    }

    public function getAPITimeout() {
        return $this->APITimeout;
    }

    public function setAPIAfterLocation($APIAfterLocation) {
        $this->APIAfterLocation = $APIAfterLocation;
        return $this;
    }

    public function setAPIComputerVisionKey1($APIComputerVisionKey1) {
        $this->APIComputerVisionKey1 = $APIComputerVisionKey1;
        return $this;
    }

    public function setAPIComputerVisionKey2($APIComputerVisionKey2) {
        $this->APIComputerVisionKey2 = $APIComputerVisionKey2;
        return $this;
    }

    public function setAPIEmotionDetectKey1($APIEmotionDetectKey1) {
        $this->APIEmotionDetectKey1 = $APIEmotionDetectKey1;
        return $this;
    }

    public function setAPIEmotionDetectKey2($APIEmotionDetectKey2) {
        $this->APIEmotionDetectKey2 = $APIEmotionDetectKey2;
        return $this;
    }

    public function setAPIResponseContent($APIResponseContent) {
        $this->APIResponseContent = $APIResponseContent;
        return $this;
    }

    public function setAPILanguage($APILanguage) {
        $this->APILanguage = $APILanguage;
        return $this;
    }

    public function setAPIMaxRedirections($APIMaxRedirections) {
        $this->APIMaxRedirections = $APIMaxRedirections;
        return $this;
    }

    public function setAPITimeout($APITimeout) {
        $this->APITimeout = $APITimeout;
        return $this;
    }

}
