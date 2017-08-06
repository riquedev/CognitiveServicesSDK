<?php

namespace rqdev\packages\ComputerVisionAPI;

class urlHelper {

    /**
     * @var mixed Versão do Http a ser utilizado
     */
    private $HttpVersion;

    /**
     *
     * @var mixed Versão do SSL a ser utilizado.
     */
    private $SSLVersion;

    /**
     * @var string Região da API
     */
    private $APILocation;

    /**
     * @var string Regiões disponíveis na API.
     */
    private $APILocationArray;

    /**
     * @var string URL complementar.
     */
    private $APIAfterLocation;

    /**
     * @var string Versão da API
     */
    private $APIVersion;

    /**
     * @var array Paths disponíveis na API
     */
    private $APIPaths;

    /**
     * @var string Path selecionado
     */
    private $SelectedPath;

    /**
     * @var string Chave Primária do Computer Vision 
     */
    private $APIComputerVisionKey1;

    /**
     * @var string Chave Secundária do Computer Vision 
     */
    private $APIComputerVisionKey2;

    /**
     * @var string Chave Primária do Emotion Detect
     */
    private $APIEmotionDetectKey1;

    /**
     * @var string Chave Secundária do Emotion Detect
     */
    private $APIEmotionDetectKey2;

    /**
     * @var string Chave Primária do Face Detect
     */
    private $APIFaceKey1;

    /**
     * @var string Chave Secundária do Face Detect
     */
    private $APIFaceKey2;

    /**
     * @var string Formato da Resposta da API. 
     */
    private $APIResponseContent;

    /**
     * @var string Idioma da API
     */
    private $APILanguage;

    /**
     * @var integer Máximo de redirecionamentos permitidos.
     */
    private $APIMaxRedirections;

    /**
     * @var integer Timeout da requisição
     */
    private $APITimeout;

    protected function Prepare() {

        /*
         *  =============   DEFAULT
         */
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
        $this->APIFaceKey1 = CVA_KEY_FACEAPI1;
        $this->APIFaceKey2 = CVA_KEY_FACEAPI2;
        $this->APIResponseContent = CVA_CONTENT;
        $this->APILanguage = CVA_LANGUAGE;
        $this->APIMaxRedirections = CVA_MAX_REDIRS;
        $this->APITimeout = CVA_TIMEOUT;
        /*
         *  =============   DEFAULT
         */
    }

    /**
     * @return mixed Versão do Http a ser utilizado.
     */
    public function getHttpVersion() {
        return $this->HttpVersion;
    }

    /**
     * @return mixed Versão do SSL a ser utilizado.
     */
    public function getSSLVersion() {
        return $this->SSLVersion;
    }

    /**
     * @return string Localização da API
     */
    public function getAPILocation() {
        return $this->APILocation;
    }

    /**
     * @return array localizações disponíveis na API.
     */
    public function getAPILocationArray() {
        return $this->APILocationArray;
    }

    /**
     * @return string Endpoint para requisição setada.
     */
    protected function getEndpoint() {
        return 'https://' . $this->APILocation . $this->APIAfterLocation .
                '/' . $this->SelectedPath . '/' . $this->APIVersion . '/';
    }

    /**
     * @return string Endpoint para o Analyze Image
     */
    public function getComputerVisionAnalyzeImage() {
        return $this->getEndpoint() . 'analyze';
    }

    /**
     * @return string Endpoint para o Describe Image
     */
    public function getComputerVisionDescribeImage() {
        return $this->getEndpoint() . 'describe';
    }

    /**
     * @return string Endpoint para o Emotion Recognition
     */
    public function getEmotionRecognition() {
        return $this->getEndpoint() . 'recognize';
    }

    /**
     * @return string Endpoint para o Face Detect
     */
    public function getFaceDetect() {
        return $this->getEndpoint() . 'detect';
    }

    /**
     * @return string Endpoint para o Tag Image
     */
    public function getComputerVisionTagImage() {
        return $this->getEndpoint() . 'tag';
    }

    /**
     * @return string Endpoint para o Handwritten Text Operation Result
     */
    public function getComputerVisionHandwrittenTextOperationResult() {
        return $this->getEndpoint() . 'textOperations';
    }

    /**
     * @return string Endpoint para o Get Thumbnail
     */
    public function getComputerVisionGetThumbnail() {
        return $this->getEndpoint() . 'generateThumbnail';
    }

    /**
     * @return string Endpoint para o List Models
     */
    public function getComputerVisionListModels() {
        return $this->getEndpoint() . 'models';
    }

    /**
     * @return string Endpoint para o Optical Character Recognition
     */
    public function getComputerVisionOpticalCharacterRecognition() {
        return $this->getEndpoint() . 'ocr';
    }

    /**
     * @return string Endpoint para o Recognize Domain Specific Content
     */
    public function getComputerVisionRecognizeDomainSpecificContent() {
        return $this->getEndpoint() . 'models';
    }

    /**
     * @return array Header Primária do Computer Vision
     */
    public function getComputerVisionHeader1() {
        return array(
            'content-type' => $this->APIResponseContent,
            'ocp-apim-subscription-key' => $this->APIComputerVisionKey1,
            'accept-encoding' => 'gzip, deflate, br',
            'cache-control' => 'no-cache'
        );
    }

    /**
     * @return array Header Secundária do Computer Vision
     */
    public function getComputerVisionHeader2() {
        return array(
            'content-type' => $this->APIResponseContent,
            'ocp-apim-subscription-key' => $this->APIComputerVisionKey2,
            'accept-encoding' => 'gzip, deflate, br',
            'cache-control' => 'no-cache'
        );
    }

    /**
     * @return array Header Primária do Emotion Recognition
     */
    public function getEmotionRecognitionHeader1() {
        return array(
            'content-type' => $this->APIResponseContent,
            'ocp-apim-subscription-key' => $this->APIEmotionDetectKey1,
            'accept-encoding' => 'gzip, deflate, br',
            'cache-control' => 'no-cache'
        );
    }

    /**
     * @return array Header Secundária do Emotion Recognition
     */
    public function getEmotionRecognitionHeader2() {
        return array(
            'content-type' => $this->APIResponseContent,
            'ocp-apim-subscription-key' => $this->APIEmotionDetectKey2,
            'accept-encoding' => 'gzip, deflate, br',
            'cache-control' => 'no-cache'
        );
    }

    /**
     * @return array Header Primária do Face API
     */
    public function getFaceAPIHeader1() {
        return array(
            'content-type' => $this->APIResponseContent,
            'ocp-apim-subscription-key' => $this->APIFaceKey1,
            'accept-encoding' => 'gzip, deflate, br',
            'cache-control' => 'no-cache'
        );
    }

    /**
     * @return array Header Secundária do Face API
     */
    public function getFaceAPIHeader2() {
        return array(
            'content-type' => $this->APIResponseContent,
            'ocp-apim-subscription-key' => $this->APIFaceKey2,
            'accept-encoding' => 'gzip, deflate, br',
            'cache-control' => 'no-cache'
        );
    }

    /**
     * @return string URL complementar.
     */
    public function getAPIAfterLocation() {
        return $this->APIAfterLocation;
    }

    /**
     * @return string Chave Primária do Computer Vision.
     */
    public function getAPIComputerVisionKey1() {
        return $this->APIComputerVisionKey1;
    }

    /**
     * @return string Chave Secundária do Computer Vision.
     */
    public function getAPIComputerVisionKey2() {
        return $this->APIComputerVisionKey2;
    }

    /**
     * @return string Chave Primária do Emotion Detect.
     */
    public function getAPIEmotionDetectKey1() {
        return $this->APIEmotionDetectKey1;
    }

    /**
     * @return string Chave Secundária do Emotion Detect.
     */
    public function getAPIEmotionDetectKey2() {
        return $this->APIEmotionDetectKey2;
    }

    /**
     * @return string Tipo de resposta esperada da API.
     */
    public function getAPIResponseContent() {
        return $this->APIResponseContent;
    }

    /**
     * @return string Idioma da API.
     */
    public function getAPILanguage() {
        return $this->APILanguage;
    }

    /**
     * @return integer Máximo de Redirecionamentos permitidos.
     */
    public function getAPIMaxRedirections() {
        return $this->APIMaxRedirections;
    }

    /**
     * @return integer timeout
     */
    public function getAPITimeout() {
        return $this->APITimeout;
    }

    /**
     * @return string Chave Primária do Face API.
     */
    public function getAPIFaceKey1() {
        return $this->APIFaceKey1;
    }

    /**
     * @return string Chave Secundária do Face API.
     */
    public function getAPIFaceKey2() {
        return $this->APIFaceKey2;
    }

    /**
     * @return string Versão da API
     */
    public function getAPIVersion() {
        return $this->APIVersion;
    }

    /**
     * @return array Paths disponíveis na API
     */
    public function getAPIPaths() {
        return $this->APIPaths;
    }

    /**
     * @return string Path selecionada
     */
    public function getSelectedPath() {
        return $this->SelectedPath;
    }

    /**
     * @param string $APIAfterLocation URL complementar
     * @return $this
     */
    public function setAPIAfterLocation(string $APIAfterLocation) {
        $this->APIAfterLocation = $APIAfterLocation;
        return $this;
    }

    /**
     * @param string $APIComputerVisionKey1 Chave Primária do Computer Vision
     * @return $this
     */
    public function setAPIComputerVisionKey1(string $APIComputerVisionKey1) {
        $this->APIComputerVisionKey1 = $APIComputerVisionKey1;
        return $this;
    }

    /**
     * @param string $APIComputerVisionKey2 Chave Secundária do Computer Vision
     * @return $this
     */
    public function setAPIComputerVisionKey2(string $APIComputerVisionKey2) {
        $this->APIComputerVisionKey2 = $APIComputerVisionKey2;
        return $this;
    }

    /**
     * @param string $APIEmotionDetectKey1 Chave Primária do Emotion Detect
     * @return $this
     */
    public function setAPIEmotionDetectKey1(string $APIEmotionDetectKey1) {
        $this->APIEmotionDetectKey1 = $APIEmotionDetectKey1;
        return $this;
    }

    /**
     * @param string $APIEmotionDetectKey2 Chave Secundária do Emotion Detect
     * @return $this
     */
    public function setAPIEmotionDetectKey2(string $APIEmotionDetectKey2) {
        $this->APIEmotionDetectKey2 = $APIEmotionDetectKey2;
        return $this;
    }

    /**
     * @param string $APIResponseContent Resposta esperada pela API.
     * @return $this
     */
    public function setAPIResponseContent(string $APIResponseContent) {
        $this->APIResponseContent = $APIResponseContent;
        return $this;
    }

    /**
     * @param string $APILanguage Idioma da API
     * @return $this
     */
    public function setAPILanguage(string $APILanguage) {
        $this->APILanguage = $APILanguage;
        return $this;
    }

    /**
     * @param int $APIMaxRedirections Limite de redirecionamentos
     * @return $this
     */
    public function setAPIMaxRedirections(int $APIMaxRedirections) {
        $this->APIMaxRedirections = $APIMaxRedirections;
        return $this;
    }

    /**
     * @param int $APITimeout
     * @return $this
     */
    public function setAPITimeout(int $APITimeout) {
        $this->APITimeout = $APITimeout;
        return $this;
    }

    /**
     * @param string $APIFaceKey1 Chave Primária do Face API.
     * @return $this
     */
    public function setAPIFaceKey1(string $APIFaceKey1) {
        $this->APIFaceKey1 = $APIFaceKey1;
        return $this;
    }

    /**
     * @param string $APIFaceKey2 Chave Secundária do Face API
     * @return $this
     */
    public function setAPIFaceKey2(string $APIFaceKey2) {
        $this->APIFaceKey2 = $APIFaceKey2;
        return $this;
    }

    /**
     * @param mixed $HttpVersion Versão do Http
     * @return $this
     */
    public function setHttpVersion($HttpVersion) {
        $this->HttpVersion = $HttpVersion;
        return $this;
    }

    /**
     * @param string $SSLVersion Versão do SSL
     * @return $this
     */
    public function setSSLVersion(string $SSLVersion) {
        $this->SSLVersion = $SSLVersion;
        return $this;
    }

    /**
     * @param string $APILocation Região da API
     * @return $this
     */
    public function setAPILocation(string $APILocation) {
        $this->APILocation = $APILocation;
        return $this;
    }

    /**
     * @param type $APIVersion Versão da API
     * @return $this
     */
    public function setAPIVersion($APIVersion) {
        $this->APIVersion = $APIVersion;
        return $this;
    }

    /**
     * @param array $APIPaths Paths da API
     * @return $this
     */
    public function setAPIPaths(array $APIPaths) {
        $this->APIPaths = $APIPaths;
        return $this;
    }

    /**
     * @param string $SelectedPath Path atual.  
     * @return $this
     */
    public function setSelectedPath(string $SelectedPath) {
        $this->SelectedPath = $SelectedPath;
        return $this;
    }

}
