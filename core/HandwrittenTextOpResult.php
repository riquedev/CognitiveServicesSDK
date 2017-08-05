<?php

namespace rqdev\packages\ComputerVisionAPI;

/*
 *  Não finalizada.
 */

class HandwrittenTextOperationResult {

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
    }

    public function Send() {
        $endPoint = CVA_COMPUTERVISION_HANDWRITTEN_TEXT_OPERATION_RESULT . '/' . $this->getOperationId();
        $headers = [];

        foreach (CVA_HEADERS_COMPUTERVISION1 as $key => $value) {
            $headers[] = $key . ":" . $value;
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
