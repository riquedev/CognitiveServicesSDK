<?php

header("Content-Type: image/jpeg");

// ../../..
$MainPath = realpath(dirname(dirname(dirname(__FILE__))));

// Incluindo arquivo correspondente a classe.
require_once($MainPath . '\core\settings.php');
require_once($MainPath . '\core\GenerateThumbnail.php');

$imageUrl = 'https://www.sketchappsources.com/resources/source-image/windows-logo-alesiamjau.png';

// Localizações da requisição
$RequestLocation = CVA_API_LOCATION_ARRAY;


// Usar header principal?
$useMainHeader = True;

// Instanciando classe...
$Thumbnail = new \rqdev\packages\ComputerVisionAPI\GenerateThumbnail();

$Sucess = $Thumbnail->setAPILocation(
                $RequestLocation[2]
        )->setHeight(600)->setWidth(600)->setSmartCropping(true)->send($imageUrl, $useMainHeader);

if ($Sucess) {
    $base64Image = $Thumbnail->response::toBase64();
    $htmlElement = $Thumbnail->response::getHtml();
    $imageProperties = $Thumbnail->response::ImageDetails();
    echo $Thumbnail->response::getImageBinary();
} else {
    var_dump($Thumbnail->error);
}


