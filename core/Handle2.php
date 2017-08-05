<?php

namespace rqdev\packages\ComputerVisionAPI;

/**
 *  Esta classe tem o objetivo de trabalhar com a leitura de imagens feita pela
 *  api. (Específica para método GET)
 * 
 *  @author Henrique da Silva Santos < rique_dev@hotmail.com >
 *  @copyright (c) 2017, Henrique da Silva Santos
 *  @license https://opensource.org/licenses/MIT
 *  @version 1.0.5
 *  @api
 */
class Handle2 {

    /**
     * cURL
     * @var object
     */
    static protected $curl = null;

    /**
     * Configurações do cURL.
     * @var array
     */
    static private $setopt = array();

    /**
     * Path atual.
     * @var string
     */
    static private $path = null;

    /**
     * Concluida com sucesso
     * @var boolean
     */
    static protected $sucess = null;

    /**
     * Erros da requisição
     * @var array
     */
    static public $error = null;

    /**
     * Resposta da requisição.
     * @var string
     */
    static public $response = null;

    /**
     * 
     * @param string $url URL da requisição.
     * @param string $file_url URL da imagem.
     * @param array $header Header da conexão.
     */
    public function __construct(string $url, array $header) {

        // Path atual
        self::$path = realpath(dirname(__FILE__));

        // Arquivo de configurações
        require_once(self::$path . "/settings.php");

        /*
         * Setando cURL
         */
        self::$curl = curl_init();
        self::$setopt[CURLOPT_URL] = $url;
        self::$setopt[CURLOPT_RETURNTRANSFER] = true;
        self::$setopt[CURLOPT_ENCODING] = "";
        self::$setopt[CURLOPT_MAXREDIRS] = CVA_MAX_REDIRS;
        self::$setopt[CURLOPT_TIMEOUT] = CVA_TIMEOUT;
        self::$setopt[CURLOPT_HTTP_VERSION] = CVA_HTTP_VERSION;
        //self::$setopt[CURLOPT_SSLVERSION] = CVA_SSL_VERSION;
        self::$setopt[CURLOPT_CUSTOMREQUEST] = "GET";
        self::$setopt[CURLOPT_HTTPHEADER] = $header;
        //self::$setopt[CURLOPT_SSL_VERIFYHOST] = 1;
        //self::$setopt[CURLOPT_SSL_VERIFYPEER] = 2;
        self::$setopt[CURLOPT_FOLLOWLOCATION] = true;
        self::$setopt[CURLOPT_CAINFO] = self::$path . "/ca-bundle.crt";

        try {
            curl_setopt_array(self::$curl, self::$setopt);
            self::$response = curl_exec(self::$curl);   // Retorno
            self::$error['error'] = curl_error(self::$curl);    // Erro (requisição)
        } catch (\Exception $ex) {
            self::errorWriter($ex); // Escreve erro (interno)
        }

        curl_close(self::$curl); // Fechando cURL
    }

    /**
     * 
     * @param \Exception $exception
     */
    static protected function errorWriter(\Exception $exception) {
        self::$error['code'] = $exception->getCode();
        self::$error['line'] = $exception->getLine();
        self::$error['message'] = $exception->getMessage();
    }

}
