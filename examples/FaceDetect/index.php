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
require_once($MainPath . '\core\FaceDetect.php');

/*
 * Imagem que será utilizada.
 */
$imageUrl = 'http://tonka3d.com.br/blog/wp-content/uploads/2012/10/games-hoplon-nunes.jpg';

// Localizações da requisição
$RequestLocation = CVA_API_LOCATION_ARRAY;


// Usar header principal?
$useMainHeader = True;

// Instanciando classe...
$Analyze = new \rqdev\packages\FaceAPI\FaceDetect();

// Preparando requisição
$Sucess = $Analyze
        ->setReturnFaceAttributes(
                [
                    CVA_FACEDETECT_ATTRIBUTE_ACCESSORIES,
                    CVA_FACEDETECT_ATTRIBUTE_AGE,
                    CVA_FACEDETECT_ATTRIBUTE_BLUR,
                    CVA_FACEDETECT_ATTRIBUTE_EMOTION,
                    CVA_FACEDETECT_ATTRIBUTE_EXPOSURE,
                    CVA_FACEDETECT_ATTRIBUTE_FACIAL_HAIR,
                    CVA_FACEDETECT_ATTRIBUTE_GENDER,
                    CVA_FACEDETECT_ATTRIBUTE_GLASSES,
                    CVA_FACEDETECT_ATTRIBUTE_HAIR,
                    CVA_FACEDETECT_ATTRIBUTE_HEADPOSE,
                    CVA_FACEDETECT_ATTRIBUTE_MAKEUP,
                    CVA_FACEDETECT_ATTRIBUTE_NOISE,
                    CVA_FACEDETECT_ATTRIBUTE_OCCLUSION,
                    CVA_FACEDETECT_ATTRIBUTE_SMILE
                ]
        )
        ->setReturnFaceId(true)
        ->setReturnFaceLandmarks(true)
        ->setAPILocation(
                // Definindo Localização
                $RequestLocation[2]
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



