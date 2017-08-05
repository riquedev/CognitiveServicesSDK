<?php

namespace rqdev\packages\ComputerVisionAPI;

class Autoloader {

    protected $files = [
        'settings',
        'AnalyzeImage',
        'DescribeImage',
        'GenerateThumbnail',
        'HandwrittenTextOpResult',
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


