<?php

namespace rqdev\packages\ComputerVisionAPI;

/**
 *  Esta classe tem o objetivo de auxiliar na manipulação do retorno
 *  da análise.
 * 
 *  @author Henrique da Silva Santos < rique_dev@hotmail.com >
 *  @copyright (c) 2017, Henrique da Silva Santos
 *  @license https://opensource.org/licenses/MIT
 *  @version 1.0.5
 * 
 */
require_once(realpath(dirname(__FILE__)) . 'urlHelper.php');

class GenerateThumbnail extends urlHelper {

    /**
     * @var integer Largura da thumbnail
     */
    private $width = 0;

    /**
     * @var integer Altura da thumbnail
     */
    private $height = 0;

    /**
     * @var boolean Corte inteligente
     */
    private $smartCropping = false;

    /** @var array|empty Lista de erros na requisição */
    public $error = [];

    /** @var mixed Resposta da requisição */
    public $response = NULL;

    public function __construct() {
        require_once(realpath(dirname(__FILE__)) . "/settings.php");
        require_once(realpath(dirname(__FILE__)) . "/Handle.php");
        require_once(realpath(dirname(__FILE__)) . "/BaseHelper.php");
        require_once(realpath(dirname(__FILE__)) . "/GenerateThumbnailHelper.php");

        // Preparando configurações da URL
        $this->Prepare();

        // Selecionando Path da API
        $this->setSelectedPath(CVA_API_PATHS[0]);
    }

    /**
     * @return integer Obtem largura da thumbnail a ser gerada.
     */
    public function getWidth() {
        return $this->width;
    }

    /**
     * @return integer Obtem altura da thumbnail a ser gerada.
     */
    public function getHeight() {
        return $this->height;
    }

    /**
     * @return boolean O corte inteligente será utilizado?
     */
    public function getSmartCropping() {
        return $this->smartCropping;
    }

    /**
     * @param int $width Define largura da thumbnail.
     * @return $this
     */
    public function setWidth(int $width) {
        $this->width = (int) $width;
        return $this;
    }

    /**
     * @param int $height Define altura da thumbnail.
     * @return $this
     */
    public function setHeight(int $height) {
        $this->height = (int) $height;
        return $this;
    }

    /**
     * @param bool $smartCropping Usa corte inteligente.
     * @return $this
     */
    public function setSmartCropping(bool $smartCropping) {
        $this->smartCropping = (bool) $smartCropping;
        return $this;
    }

    /**
     * Faz a requisição ao servidor.
     * @param string $imageUrl Link da imagem que será analisada.
     * @param boolean $useMainHeader Usar a Header principal
     * @return boolean Sucesso
     */
    public function Send(string $imageUrl, bool $useMainHeader = true) {
        $endPoint = $this->getComputerVisionGetThumbnail() . '?width=' .
                $this->getWidth() .
                '&height=' . $this->getHeight() .
                '&smartCropping=' . strval($this->getSmartCropping());

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

        $handle = new Handle($endPoint, $imageUrl, $headers);

        if (!$handle::$error) {
            $this->error = $handle::$error;
            return false;
        } else {
            $this->response = (new GenerateThumbnail\Helper($handle::$response));
            return true;
        }
    }

}
