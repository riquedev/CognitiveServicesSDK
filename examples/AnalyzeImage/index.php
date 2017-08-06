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
require_once($MainPath . '\core\AnalyzeImage.php');

/*
 * Imagem que será utilizada.
 */
$imageUrl = 'http://i.imgur.com/wS5Kkbr.png';

// Localizações da requisição
$RequestLocation = CVA_API_LOCATION_ARRAY;


// Usar header principal?
$useMainHeader = True;

// Instanciando classe...
$Analyze = new \rqdev\packages\ComputerVisionAPI\AnalyzeImage();

// Preparando requisição
$Sucess = $Analyze
        ->setAPILocation(
                $RequestLocation[2] // wescentralus
        )
        ->setDetails(
                [
                    // Detalhes que serão obtidos
                    CVA_DETAILS_CELEBRITIES,
                    CVA_DETAILS_LANDMARKS
                ]
        )
        ->setVisualFeatures(
                [
                    // Características Visuais
                    CVA_VISUAL_FEATURES_ADULT,
                    CVA_VISUAL_FEATURES_CATEGORIES,
                    CVA_VISUAL_FEATURES_COLOR,
                    CVA_VISUAL_FEATURES_DESCRIPTION,
                    CVA_VISUAL_FEATURES_DESCRIPTION,
                    CVA_VISUAL_FEATURES_FACES,
                    CVA_VISUAL_FEATURES_IMAGE_TYPE,
                    CVA_VISUAL_FEATURES_TAGS
                ]
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



