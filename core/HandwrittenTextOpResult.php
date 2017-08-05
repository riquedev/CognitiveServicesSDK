<?php

namespace rqdev\packages\ComputerVisionAPI;

/*
 *  Não finalizada.
 */
require_once(realpath(dirname(__FILE__)) . '\urlHelper.php');

class HandwrittenTextOperationResult extends urlHelper {

    private $operationId;

    public function getOperationId() {
        return $this->operationId;
    }

    public function setOperationId($operationId) {
        $this->operationId = $operationId;
        return $this;
    }

    public function __construct() {
        require_once(realpath(dirname(__FILE__)) . "/settings.php");
        require_once(realpath(dirname(__FILE__)) . "/Handle2.php");
        require_once(realpath(dirname(__FILE__)) . "/BaseHelper.php");
        require_once(realpath(dirname(__FILE__)) . "/HTOPHelper.php");

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
        $endPoint = $this->getComputerVisionHandwrittenTextOperationResult() . '/' . $this->getOperationId();
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
            $this->response = (new \rqdev\packages\ComputerVisionAPI\HandwrittenTextOperationResult\Helper($handle::$response));
            return true;
        }
    }

}
