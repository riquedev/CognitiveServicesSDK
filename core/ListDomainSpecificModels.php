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
class ListDomainSpecificModels {

    public function __construct() {
        require_once(realpath(dirname(__FILE__)) . "/settings.php");
        require_once(realpath(dirname(__FILE__)) . "/Handle2.php");
        require_once(realpath(dirname(__FILE__)) . "/BaseHelper.php");
    }

    /**
     * Faz a requisição ao servidor.
     * @param string $imageUrl Link da imagem que será analisada.
     * @return boolean Sucesso
     */
    public function Send() {
        $endPoint = CVA_COMPUTERVISION_LISTDOMAINSPECIFICMODELS;
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
