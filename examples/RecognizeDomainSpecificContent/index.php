<?php

header("Content-type:application/json");
// ../../..
$MainPath = realpath(dirname(dirname(dirname(__FILE__))));

// Incluindo arquivo correspondente a classe.
require_once($MainPath . '\core\settings.php');
require_once($MainPath . '\core\RecognizeDomainSpecificContent.php');

// Localizações da requisição
$RequestLocation = CVA_API_LOCATION_ARRAY;


$imageUrl = 'http://cdn.ofuxico.com.br/img/upload/noticias/2017/03/05/24_289077_36.jpg';

// Usar header principal?
$useMainHeader = True;

// Instanciando classe...
$Analyze = new \rqdev\packages\ComputerVisionAPI\RecognizeDomainSpecificContent();


$Sucess = $Analyze->setAPILocation($RequestLocation[2])->setModel(CVA_RECOGNIZEDOMAINSPECIFICCONTENT_CELEBRITIES)->Send($imageUrl, $useMainHeader);


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



