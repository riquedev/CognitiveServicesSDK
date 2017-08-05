<?php

namespace rqdev\packages\ComputerVisionAPI\OpticalCharacterRecognition;

class Helper extends \rqdev\packages\ComputerVisionAPI\Helper {

    static protected $json;

    public function getLanguage() {
        return $this->toArray()['language'];
    }

    public function getTextAngle() {
        return $this->toArray()['textAngle'];
    }

    public function getOrientation() {
        return $this->toArray()['orientation'];
    }

    public function getRegions() {
        return $this->toArray()['regions'];
    }

}
