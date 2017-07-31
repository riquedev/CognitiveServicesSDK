<?php

namespace rqdev\packages\ComputerVisionAPI;

class Handle {

    static protected $curl = null;
    static private $setopt = array();
    static private $path = null;
    static protected $sucess = null;
    static public $error = null;
    static public $response = null;

    public function __construct(string $url, string $file_url, array $header) {
        
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
        self::$setopt[CURLOPT_CUSTOMREQUEST] = "POST";
        self::$setopt[CURLOPT_POSTFIELDS] = json_encode(['url' => $file_url]);
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

    static protected function errorWriter(\Exception $exception) {
        self::$error['code'] = $exception->getCode();
        self::$error['line'] = $exception->getLine();
        self::$error['message'] = $exception->getMessage();
    }

}
