<?php

namespace rqdev\packages\ComputerVisionAPI;

class urlHelper {

    static private $HttpVersion;
    static private $SSLVersion;
    static private $APILocation;
    static private $APILocationArray;
    static private $APIAfterLocation;
    static private $APIVersion;
    static private $APIPaths;
    static private $SelectedPath;
    static private $APIComputerVisionKey1;
    static private $APIComputerVisionKey2;
    static private $APIEmotionDetectKey1;
    static private $APIEmotionDetectKey2;
    static private $APIResponseContent;
    static private $APILanguage;
    static private $APIMaxRedirections;
    static private $APITimeout;

    protected function Prepare() {

        self::$HttpVersion = CVA_HTTP_VERSION;
        self::$SSLVersion = CVA_SSL_VERSION;
        self::$APILocation = CVA_API_LOCATION_ARRAY[0];
        self::$APILocationArray = CVA_API_LOCATION_ARRAY;
        self::$APIVersion = CVA_API_VERSION;
        self::$APIPaths = CVA_API_PATHS;
        self::$SelectedPath = self::$APIPaths[0];
        self::$APIAfterLocation = CVA_AFTER_LOCATION;
        self::$APIComputerVisionKey1 = CVA_KEY_COMPUTERVISION1;
        self::$APIComputerVisionKey2 = CVA_KEY_COMPUTERVISION2;
        self::$APIEmotionDetectKey1 = CVA_KEY_EMOTIONDETECT1;
        self::$APIEmotionDetectKey2 = CVA_KEY_EMOTIONDETECT2;
        self::$APIResponseContent = CVA_CONTENT;
        self::$APILanguage = CVA_LANGUAGE;
        self::$APIMaxRedirections = CVA_MAX_REDIRS;
        self::$APITimeout = CVA_TIMEOUT;
    }

    public static function getHttpVersion() {
        return self::$HttpVersion;
    }

    public static function getSSLVersion() {
        return self::$SSLVersion;
    }

    public static function getAPILocation() {
        return self::$APILocation;
    }

    public static function getAPILocationArray() {
        return self::$APILocationArray;
    }

    public static function setHttpVersion($HttpVersion) {
        self::$HttpVersion = $HttpVersion;
        return self;
    }

    public static function setSSLVersion($SSLVersion) {
        self::$SSLVersion = $SSLVersion;
        return self;
    }

    public static function setAPILocation($APILocation) {
        self::$APILocation = $APILocation;
        return self;
    }

    public static function getAPIVersion() {
        return self::$APIVersion;
    }

    public static function getAPIPaths() {
        return self::$APIPaths;
    }

    public static function getSelectedPath() {
        return self::$SelectedPath;
    }

    public static function setAPIVersion($APIVersion) {
        self::$APIVersion = $APIVersion;
        return self;
    }

    public static function setAPIPaths($APIPaths) {
        self::$APIPaths = $APIPaths;
        return self;
    }

    public static function setSelectedPath($SelectedPath) {
        self::$SelectedPath = $SelectedPath;
        return self;
    }

    protected static function getEndpoint() {
        return 'https://' . self::$APILocation . self::$APIAfterLocation .
                '/' . self::$SelectedPath . '/' . self::$APIVersion . '/';
    }

    public static function getComputerVisionAnalyzeImage() {
        return self::getEndpoint() . 'analyze';
    }

    public static function getComputerVisionDescribeImage() {
        return self::getEndpoint() . 'describe';
    }

    public static function getComputerVisionHandwrittenTextOperationResult() {
        return self::getEndpoint() . 'textOperations';
    }

    public static function getComputerVisionGetThumbnail() {
        return self::getEndpoint() . 'generateThumbnail';
    }

    public static function getComputerVisionListModels() {
        return self::getEndpoint() . 'models';
    }

    public static function getComputerVisionOpticalCharacterRecognition() {
        return self::getEndpoint() . 'ocr';
    }

    public static function getComputerVisionHeader1() {
        return array(
            'content-type' => self::$APIResponseContent,
            'ocp-apim-subscription-key' => self::$APIComputerVisionKey1,
            'accept-encoding' => 'gzip, deflate, br',
            'cache-control' => 'no-cache'
        );
    }

    public static function getComputerVisionHeader2() {
        return array(
            'content-type' => self::$APIResponseContent,
            'ocp-apim-subscription-key' => self::$APIComputerVisionKey2,
            'accept-encoding' => 'gzip, deflate, br',
            'cache-control' => 'no-cache'
        );
    }

    public static function getAPIAfterLocation() {
        return self::$APIAfterLocation;
    }

    public static function getAPIComputerVisionKey1() {
        return self::$APIComputerVisionKey1;
    }

    public static function getAPIComputerVisionKey2() {
        return self::$APIComputerVisionKey2;
    }

    public static function getAPIEmotionDetectKey1() {
        return self::$APIEmotionDetectKey1;
    }

    public static function getAPIEmotionDetectKey2() {
        return self::$APIEmotionDetectKey2;
    }

    public static function getAPIResponseContent() {
        return self::$APIResponseContent;
    }

    public static function getAPILanguage() {
        return self::$APILanguage;
    }

    public static function getAPIMaxRedirections() {
        return self::$APIMaxRedirections;
    }

    public static function getAPITimeout() {
        return self::$APITimeout;
    }

    public static function setAPIAfterLocation($APIAfterLocation) {
        self::$APIAfterLocation = $APIAfterLocation;
        return self;
    }

    public static function setAPIComputerVisionKey1($APIComputerVisionKey1) {
        self::$APIComputerVisionKey1 = $APIComputerVisionKey1;
        return self;
    }

    public static function setAPIComputerVisionKey2($APIComputerVisionKey2) {
        self::$APIComputerVisionKey2 = $APIComputerVisionKey2;
        return self;
    }

    public static function setAPIEmotionDetectKey1($APIEmotionDetectKey1) {
        self::$APIEmotionDetectKey1 = $APIEmotionDetectKey1;
        return self;
    }

    public static function setAPIEmotionDetectKey2($APIEmotionDetectKey2) {
        self::$APIEmotionDetectKey2 = $APIEmotionDetectKey2;
        return self;
    }

    public static function setAPIResponseContent($APIResponseContent) {
        self::$APIResponseContent = $APIResponseContent;
        return self;
    }

    public static function setAPILanguage($APILanguage) {
        self::$APILanguage = $APILanguage;
        return self;
    }

    public static function setAPIMaxRedirections($APIMaxRedirections) {
        self::$APIMaxRedirections = $APIMaxRedirections;
        return self;
    }

    public static function setAPITimeout($APITimeout) {
        self::$APITimeout = $APITimeout;
        return self;
    }

}
