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
require_once($MainPath . '\core\OpticalCharacterRecognition.php');

// Localizações da requisição
$RequestLocation = CVA_API_LOCATION_ARRAY;

/*
 * Imagem que será utilizada.
 */
$imageUrl = 'http://jcoutinhomaimai.com.br/wp-content/uploads/2013/04/Placa.jpg';

// Usar header principal?
$useMainHeader = True;

// Instanciando classe...
$Analyze = new \rqdev\packages\ComputerVisionAPI\OpticalCharacterRecognition();

$Sucess = $Analyze
        ->setAPILocation($RequestLocation[2])
        ->setLanguage(CVA_OCR_LANGUAGE[0][1])
        ->setDetectOrientation(true)
        ->Send($imageUrl);

if ($Sucess) {
    // Resposta
    $ResponseObject = $Analyze->getResponse();

    // Identificando idioma
    $DetectedLanguage = $ResponseObject->getLanguage();

    // Ângulo do Texto
    $TextAngle = $ResponseObject->getTextAngle();

    // Orientation
    $Orientation = $ResponseObject->getOrientation();

    // Regiões / Palavras
    $RegionWords = $ResponseObject->getRegions();

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



