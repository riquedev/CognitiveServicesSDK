<?php

namespace rqdev\packages\ComputerVisionAPI;

/**
 *  Esta classe tem o objetivo de auxiliar como base na manipulação de retornos
 *  da API.
 * 
 *  @author Henrique da Silva Santos < rique_dev@hotmail.com >
 *  @copyright (c) 2017, Henrique da Silva Santos
 *  @license https://opensource.org/licenses/MIT
 *  @version 1.0.5
 * 
 */
class Helper {

    static protected $json;

    public function __construct(string $json) {
        self::$json = $json;
    }

    /**
     * Transforma a resposta da requisição em um array.
     * @return array Retorno em array.
     */
    static public function toArray() {
        return json_decode(self::$json, true);
    }

    /**
     * Transforma a resposta da requisição em um Json.
     * @param boolean $pretty Pretty Json
     * @return string|json Retorno em json
     */
    static public function toJson(bool $pretty = false) {
        return $pretty ? json_encode(self::toArray(), JSON_PRETTY_PRINT) : self::$json;
    }

    /**
     * Transforma a resposta da requisição em um objeto.
     * @return object
     */
    static public function toObject() {
        return (object) self::toArray();
    }

}
