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
class DescribeImage {

    /** @var string Máximo de descrições no retorno. */
    private $maxCandidates = "1";

    /** @var array|empty Lista de erros na requisição */
    public $error = [];

    /** @var mixed Resposta da requisição */
    public $response = NULL;

    public function __construct() {
        require_once(realpath(dirname(__FILE__)) . "/settings.php");
        require_once(realpath(dirname(__FILE__)) . "/Handle.php");
        require_once(realpath(dirname(__FILE__)) . "/BaseHelper.php");
        require_once(realpath(dirname(__FILE__)) . "/DescribeImageHelper.php");
    }

    /**
     * Retorna o total de descrições pedidas no retorno.
     * @return string
     */
    public function getMaxCandidates() {
        return $this->maxCandidates;
    }

    /**
     * Insere o máximo de descrições no retorno.
     * @param string $maxCandidates
     * @return $this
     */
    public function setMaxCandidates(string $maxCandidates) {
        $this->maxCandidates = $maxCandidates;
        return $this;
    }

    /**
     * Faz a requisição ao servidor.
     * @param string $imageUrl Link da imagem que será analisada.
     * @return boolean Sucesso
     */
    public function Send(string $imageUrl) {
        $endPoint = CVA_COMPUTERVISION_DESCRIBEIMAGE . '?maxCandidates=' . $this->getMaxCandidates();

        $headers = [];

        foreach (CVA_HEADERS_COMPUTERVISION1 as $key => $value) {
            $headers[] = $key . ":" . $value;
        }

        $handle = new Handle($endPoint, $imageUrl, $headers);

        if (!$handle::$error) {
            $this->error = $handle::$error;
            return false;
        } else {
            $this->response = (new DescribeImage\Helper($handle::$response));
            return true;
        }
    }

}
