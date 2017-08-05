<?php

namespace rqdev\packages\ComputerVisionAPI;

/**
 *  Esta classe tem o objetivo de trabalhar com a leitura de imagens feita pela
 *  api.
 * 
 *  @author Henrique da Silva Santos < rique_dev@hotmail.com >
 *  @copyright (c) 2017, Henrique da Silva Santos
 *  @license https://opensource.org/licenses/MIT
 *  @version 1.0.5
 * 
 */
class AnalyzeImage {

    /** @var array|empty Características visuais */
    private $visualFeatures = [];

    /** @var array|empty Detalhes que deseja obter. */
    private $details = [];

    /** @var string|en Idioma do retorno */
    private $language = 'en';

    /** @var array|empty Lista de erros na requisição */
    public $error = [];

    /** @var mixed Resposta da requisição */
    public $response = NULL;

    public function __construct() {
        require_once(realpath(dirname(__FILE__)) . "/settings.php");
        require_once(realpath(dirname(__FILE__)) . "/Handle.php");
        require_once(realpath(dirname(__FILE__)) . "/BaseHelper.php");
        require_once(realpath(dirname(__FILE__)) . "/AnalyzeImageHelper.php");
    }

    /**
     * Retorna a lista de características visuais desejadas durante o retorno.
     * @return array
     */
    public function getVisualFeatures() {
        return $this->visualFeatures;
    }

    /**
     * Retorna a lista de detalhes desejados no retorno
     * @return array
     */
    public function getDetails() {
        return $this->details;
    }

    /**
     * Retorna a linguagem do retorno.
     * @return string
     */
    public function getLanguage() {
        return $this->language;
    }

    /**
     * Insere os detalhes desejados no retorno.
     * @param mixed $details Detalhes. ( encontrados em core\settings.php )
     * @return $this
     */
    public function setDetails($details) {
        $this->details = $details;
        return $this;
    }

    /**
     * Seleciona o idioma do retorno. 
     * @param string $language Ex.: en
     * @return $this
     */
    public function setLanguage($language) {
        $this->language = $language;
        return $this;
    }

    /**
     * Seleciona a lista de características visuais desejadas.
     * @param array $visualFeatures Características visuais. ( encontrados em core\settings.php )
     * @return $this
     */
    public function setVisualFeatures(array $visualFeatures) {
        $this->visualFeatures = $visualFeatures;
        return $this;
    }

    /**
     * Faz a requisição ao servidor.
     * @param string $imageUrl Link da imagem que será analisada.
     * @return boolean Sucesso
     */
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
            $this->response = (new AnalyzeImage\Helper($handle::$response));
            return true;
        }
    }

}
