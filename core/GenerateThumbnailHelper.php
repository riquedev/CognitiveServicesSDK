<?php

namespace rqdev\packages\ComputerVisionAPI\GenerateThumbnail;

trait ImageProperties {

    /**
     * @var string|base64 Dados já convertidos. 
     */
    static protected $data;

    /**
     * @var array Propriedades da imagem.
     */
    static protected $properties;

    /**
     * @return string Nome do arquivo gerado.
     */
    static public function FileName() {
        return self::$properties['FileName'];
    }

    /**
     * @return mixed
     */
    static public function FileDateTime() {
        return self::$properties['FileDateTime'];
    }

    /**
     * @return integer Tamanho do arquivo.
     */
    static public function FileSize() {
        return self::$properties['FileSize'];
    }

    /**
     * @return integer Tipo do arquivo.
     */
    static public function FileType() {
        return self::$properties['FileType'];
    }

    /**
     * @return string MimeType do arquivo
     */
    static public function MimeType() {
        return self::$properties['MimeType'];
    }

    /**
     * @return string Seções encontradas no arquivo.
     */
    static public function SectionsFound() {
        return self::$properties['SectionsFound'];
    }

    /**
     * @return array Propriedades gerais do arquivo.
     */
    static public function getProperties() {
        return self::$properties;
    }

}

/**
 *  Esta classe tem o objetivo de auxiliar na manipulação do retorno
 *  binário da API.
 *  Esta classe não é subordinada ao BaseHelper.
 * 
 *  @author Henrique da Silva Santos < rique_dev@hotmail.com >
 *  @copyright (c) 2017, Henrique da Silva Santos
 *  @license https://opensource.org/licenses/MIT
 *  @version 1.0.5
 *  @package \rqdev\packages\ComputerVisionAPI
 *  @subpackage \rqdev\packages\ComputerVisionAPI\GenerateThumbnail
 * 
 */ 
class Helper {

    /**
     * @var string|binary Dados binários do arquivo. 
     */
    static protected $imageData;

    public function __construct(string $imageData) {
        self::$imageData = $imageData;
    }

    /**
     * @return string|base64 Converte o arquivo para base64.
     */
    static public function toBase64() {
        return base64_encode(self::$imageData);
    }

    /**
     * @return string Obtem HTML para visualizar imagem.
     */
    static public function getHtml() {
        $details = self::ImageDetails();
        $data = 'data://' . $details::MimeType() . ';base64,' . self::toBase64();
        $str = '<img src="' . $data . '" "' . $details::getProperties()['COMPUTED']['html'] . '>';
        return $str;
    }

    static public function getImageBinary() {
        return self::$imageData;
    }

    /**
     * @return class|anonymous Classe anônima para obter dados da imagem.
     */
    static public function ImageDetails() {

        return new class(self::toBase64()) {

            use ImageProperties;

            public function __construct(string $base64) {
                self::$data = $base64;
                self::$properties = exif_read_data('data://image/jpeg;base64,' . self::$data);
            }
        };
    }

}
