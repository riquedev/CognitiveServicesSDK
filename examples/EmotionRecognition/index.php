<?php

/*
 *  Header que será utilizado.
 */
header("Content-type:application/json");

/*
 * Obtendo o Path principal
 */
$MainPath = realpath(dirname(dirname(dirname(__FILE__))));

// Incluindo arquivo correspondente a classe.
require_once($MainPath . '\core\settings.php');
require_once($MainPath . '\core\EmotionRecognition.php');

/*
 * Imagem que será utilizada.
 */
$imageUrl = 'http://r3gestao.com.br/wp-content/uploads/2016/06/imagens-imagens-pessoas-6d9054.jpg';

// Localizações da requisição
$RequestLocation = CVA_API_LOCATION_ARRAY;


// Usar header principal?
$useMainHeader = True;

// Instanciando classe...
$Analyze = new \rqdev\packages\EmotionDetectionAPI\EmotionRecognition();

// Preparando requisição
$Sucess = $Analyze
        ->setAPILocation(
                // Definindo Localização
                $RequestLocation[0]
        )
        ->Send($imageUrl, $useMainHeader);

if ($Sucess) {
    // Resposta
    $ResponseObject = $Analyze->getResponse();

    // Pretty-Print
    $prettyJson = true;

    // Json
    $JsonResponse = $ResponseObject->toJson($prettyJson);

    // Array
    $ArrayResponse = $ResponseObject->toArray();

    // Objeto
    $ObjectResponse = $ResponseObject->toObject();

    // Resposta JSON
    echo $JsonResponse;
} else {
    var_dump($Analyze->getError());
}



