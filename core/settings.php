<?php

namespace rqdev\packages\ComputerVisionAPI\consts;

/*
 * Qual versão do HTTP utilizaremos.
 */
define("CVA_HTTP_VERSION", CURL_HTTP_VERSION_1_1);

/*
 * Qual versão SSL vamos usar
 */
define("CVA_SSL_VERSION", CURL_SSLVERSION_DEFAULT);

/*
 * SERVER LOCATION
 * West US - westus
 * East US 2 - eastus2
 * West Central US - westcentralus
 * West Europe - westeurope
 * Southeast Asia - southeastasia
 */

define("CVA_API_LOCATION", "westcentralus");

/*
 * END POINT DA API
 */
define("CVA_ENDPOINT", "https://" . CVA_API_LOCATION . ".api.cognitive.microsoft.com/vision/v1.0/");
define("CVA_COMPUTERVISION_ANALYZEIMAGE", CVA_ENDPOINT . "analyze");
define("CVA_COMPUTERVISION_DESCRIBEIMAGE", CVA_ENDPOINT . "describe");
define("CVA_COMPUTERVISION_HANDWRITTEN_TEXT_OPERATION_RESULT",CVA_ENDPOINT."textOperations");
define("CVA_COMPUTERVISION_GET_THUMBNAIL",CVA_ENDPOINT."generateThumbnail");

/*
 * Chave da API, podem ser obtidas em:
 * ( Computer Vision )
 */
define("CVA_KEY_COMPUTERVISION1", "2b52efb5378e4bfb9dac2f1d0b806072");

define("CVA_KEY_COMPUTERVISION2", "685a641c1cfd4d3780a20b12e306e464");

/*
 * Retorno
 */
define("CVA_CONTENT", "application/json");

/*
 * Header para requisição
 * ( Computer Vision)
 */
define("CVA_HEADERS_COMPUTERVISION1", array(
    'content-type' => CVA_CONTENT,
    'ocp-apim-subscription-key' => CVA_KEY_COMPUTERVISION1,
    'accept-encoding' => 'gzip, deflate, br',
    'cache-control' => 'no-cache',
    'content-type' => 'application/json'
));

define("CVA_HEADERS_COMPUTERVISION2", array(
    'content-type' => CVA_CONTENT,
    'ocp-apim-subscription-key' => CVA_KEY_COMPUTERVISION2,
    'accept-encoding' => 'gzip, deflate, br',
    'cache-control' => 'no-cache',
    'content-type' => 'application/json'
));

// Idioma
define("CVA_LANGUAGE", 'en'); // zh
// Limite de redirecionamentos
define("CVA_MAX_REDIRS", 10);

// Tempo de espera
define("CVA_TIMEOUT", 30);

/*
 * Opções da API
 * ( Computer Vision )
 */
define("CVA_VISUAL_FEATURES_CATEGORIES", "Categories");

define("CVA_VISUAL_FEATURES_TAGS", "Tags");

define("CVA_VISUAL_FEATURES_DESCRIPTION", "Description");

define("CVA_VISUAL_FEATURES_FACES", "Faces");

define("CVA_VISUAL_FEATURES_IMAGE_TYPE", "ImageType");

define("CVA_VISUAL_FEATURES_COLOR", "Color");

define("CVA_VISUAL_FEATURES_ADULT", "Adult");

define("CVA_DETAILS_CELEBRITIES", "Celebrities");

define("CVA_DETAILS_LANDMARKS", "Landmarks");


