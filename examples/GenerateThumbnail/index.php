<?php

/*
 *  Header que será utilizado.
 */
header("Content-Type: image/jpeg");

/*
 * Obtendo o Path principal
 */
$MainPath = realpath(dirname(dirname(dirname(__FILE__))));

// Incluindo arquivo correspondente a classe.
require_once($MainPath . '\core\settings.php');
require_once($MainPath . '\core\GenerateThumbnail.php');

/*
 * Imagem que será utilizada.
 */
$imageUrl = 'https://www.sketchappsources.com/resources/source-image/windows-logo-alesiamjau.png';

// Localizações da requisição
$RequestLocation = CVA_API_LOCATION_ARRAY;


// Usar header principal?
$useMainHeader = True;

// Instanciando classe...
$Thumbnail = new \rqdev\packages\ComputerVisionAPI\GenerateThumbnail();

$Sucess = $Thumbnail
        ->setAPILocation($RequestLocation[2])
        ->setHeight(600)
        ->setWidth(600)
        ->setSmartCropping(true)
        ->send($imageUrl, $useMainHeader);

if ($Sucess) {
    $base64Image = $Thumbnail->getResponse()::toBase64();
    $htmlElement = $Thumbnail->getResponse()::getHtml();
    $imageProperties = $Thumbnail->getResponse()::ImageDetails();
    echo $Thumbnail->getResponse()->getImageBinary();
} else {
    var_dump($Thumbnail->error);
}


