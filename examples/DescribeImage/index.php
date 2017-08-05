<?php

header("Content-type:application/json");
// ../../..
$MainPath = realpath(dirname(dirname(dirname(__FILE__))));

// Incluindo arquivo correspondente a classe.
require_once($MainPath . '\core\settings.php');
require_once($MainPath . '\core\DescribeImage.php');

$imageUrl = 'https://i.ytimg.com/vi/txMe-oU26OY/maxresdefault.jpg';

// Localizações da requisição
$RequestLocation = CVA_API_LOCATION_ARRAY;


// Usar header principal?
$useMainHeader = True;

// Instanciando classe...
$Analyze = new \rqdev\packages\ComputerVisionAPI\DescribeImage();

// Preparando requisição
$Sucess = $Analyze->setAPILocation(
                // Definindo Localização
                $RequestLocation[2]
        )->setMaxCandidates(30)->Send($imageUrl, $useMainHeader);

if ($Sucess) {
    // Resposta
    $ResponseObject = $Analyze->response;

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
    var_dump($Analyze->error);
}



