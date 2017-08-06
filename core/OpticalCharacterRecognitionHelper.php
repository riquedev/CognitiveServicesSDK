<?php

namespace rqdev\packages\ComputerVisionAPI\OpticalCharacterRecognition;

/**
 * Este helper tem como objetivo auxiliar na manipulação do retorno da API.
 * Você é livre para implementar as funções que julgar necessárias, por favor,
 * compartilhe suas modificações conosco.
 * <  https://github.com/riquedev/CognitiveServicesSDK >
 * 
 *  @author Henrique da Silva Santos < rique_dev@hotmail.com >
 *  @copyright (c) 2017, Henrique da Silva Santos
 *  @license https://opensource.org/licenses/MIT
 *  @version 1.0.5
 *  @package \rqdev\packages\ComputerVisionAPI
 *  @subpackage \rqdev\packages\ComputerVisionAPI\OpticalCharacterRecognition
 */
class Helper extends \rqdev\packages\ComputerVisionAPI\Helper {

    static protected $json;

    /**
     * @return string Idioma detectado
     */
    public function getLanguage() {
        return $this->toArray()['language'];
    }

    /**
     * @return float Ângulo do texto.
     */
    public function getTextAngle() {
        return $this->toArray()['textAngle'];
    }

    /**
     * @return string Orientação do texto.
     */
    public function getOrientation() {
        return $this->toArray()['orientation'];
    }

    /**
     * @return array Regiões de texto.
     */
    public function getRegions() {
        return $this->toArray()['regions'];
    }

}
