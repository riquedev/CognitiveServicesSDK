<?php

namespace rqdev\packages\ComputerVisionAPI;

class Autoloader {

    protected $files = [
        'settings',
        'AnalyzeImage',
        'DescribeImage',
        'EmotionRecognition',
        'FaceDetect',
        'GenerateThumbnail',
        // Não finalizado => 'HandwrittenTextOpResult',
        'ListDomainSpecificModels',
        'OpticalCharacterRecognition',
        'RecognizeDomainSpecificContent',
        'TagImage'
    ];

    public function __construct() {
        foreach ($this->files as $file) {
            require_once(realpath(dirname(__FILE__)) . '/' . $file . '.php');
        }
    }

}

new Autoloader;


