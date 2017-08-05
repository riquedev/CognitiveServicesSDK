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
require_once(realpath(dirname(__FILE__)) . '\urlHelper.php');

class ListDomainSpecificModels extends urlHelper {

    /** @var array|empty Lista de erros na requisição */
    public $error = [];

    /** @var mixed Resposta da requisição */
    public $response = NULL;

    public function __construct() {
        require_once(realpath(dirname(__FILE__)) . "/settings.php");
        require_once(realpath(dirname(__FILE__)) . "/Handle2.php");
        require_once(realpath(dirname(__FILE__)) . "/BaseHelper.php");
        require_once(realpath(dirname(__FILE__)) . "/ListDomainSpecificModelsHelper.php");
        // Preparando configurações da URL
        $this->Prepare();

        // Selecionando Path da API
        $this->setSelectedPath(CVA_API_PATHS[0]);
    }

    /**
     * Faz a requisição ao servidor.
     * @param boolean $useMainHeader Usar a Header principal
     * @return boolean Sucesso
     */
    public function Send(bool $useMainHeader = true) {
        $endPoint = $this->getComputerVisionListModels();
        $headers = [];

        if ($useMainHeader) {
            foreach ($this->getComputerVisionHeader1() as $key => $value) {
                $headers[] = $key . ":" . $value;
            }
        } else {
            foreach ($this->getComputerVisionHeader2() as $key => $value) {
                $headers[] = $key . ":" . $value;
            }
        }

        $handle = new Handle2($endPoint, $headers);

        if (!$handle::$error) {
            $this->error = $handle::$error;
            return false;
        } else {
            $this->response = (new \rqdev\packages\ComputerVisionAPI\ListDomainSpecificModels\Helper($handle::$response));
            return true;
        }
    }

}
