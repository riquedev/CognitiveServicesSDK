<?php

namespace rqdev\packages\ComputerVisionAPI\DescribeImage;

/**
 *  Esta classe tem o objetivo de auxiliar na manipulação do retorno
 *  da análise.
 * 
 *  @author Henrique da Silva Santos < rique_dev@hotmail.com >
 *  @copyright (c) 2017, Henrique da Silva Santos
 *  @license https://opensource.org/licenses/MIT
 *  @version 1.0.5
 * 
 */
trait ImageMetaData {
    /**
     * Manipulação dos metadados da imagem.
     */

    /** @var array Metadados */
    public $metaData = [];

    /**
     * Obtem largura da imagem.
     * @return float
     */
    public function getWidth() {
        return $this->metaData['width'];
    }
    
    /**
     * Obtem a altura da imagem.
     * @return float
     */
    public function getHeight() {
        return $this->metaData['height'];
    }
    
    /**
     * Obtem o formato da imagem.
     * @return string
     */
    public function getFormat() {
        return $this->metaData['format'];
    }

}

class Helper extends \rqdev\packages\ComputerVisionAPI\Helper {

    static protected $json;

    /**
     * Obtem tags das descrições
     * @return array
     */
    public function getDescriptionTags() {
        return $this->toArray()['description']['tags'];
    }

    /**
     * Obtem descrições
     * @return array
     */
    public function getDescriptionCaptions() {
        return $this->toArray()['description']['captions'];
    }

    /**
     * Obtem id da requisição
     * @return string
     */
    public function getRequestId() {
        return $this->toArray()['requestId'];
    }
    
    /**
     * Obtem metadados da imagem.
     * @return mixed
     */

    public function getMetaData() {
        return (new class($this->toArray()['metadata']) {

                    use ImageMetaData;

                    public function __construct($metadata) {
                        $this->metaData = $metadata;
                    }
                });
    }

}
