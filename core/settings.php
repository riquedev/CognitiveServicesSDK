<?php

namespace rqdev\packages\ComputerVisionAPI\consts;

/**
 * Versão do HTTP utilizado
 */
define("CVA_HTTP_VERSION", CURL_HTTP_VERSION_1_1);

/**
 * Versão do SSL
 */
define("CVA_SSL_VERSION", CURL_SSLVERSION_DEFAULT);

/**
 * @deprecated
 */
define("CVA_API_LOCATION", "westcentralus");

/**
 * SERVER LOCATION
 * West US - westus
 * East US 2 - eastus2
 * West Central US - westcentralus
 * West Europe - westeurope
 * Southeast Asia - southeastasia
 */
define("CVA_API_LOCATION_ARRAY", [
    'westus',
    'eastus2',
    'westcentralus',
    'westeurope',
    'southeastasia'
        ]
);


define("CVA_API_VERSION", 'v1.0');
define("CVA_AFTER_LOCATION", '.api.cognitive.microsoft.com');
define("CVA_API_PATHS", ['vision', 'emotion', 'face']);

/**
 * Endpoint principal
 * @deprecated 
 */
define("CVA_ENDPOINT", "https://" . CVA_API_LOCATION . ".api.cognitive.microsoft.com/vision/v1.0/");

/**
 * Endpoint - Análise de Imagens
 */
define("CVA_COMPUTERVISION_ANALYZEIMAGE", CVA_ENDPOINT . "analyze");

/**
 * Endpoint - Descrever Imagens
 */
define("CVA_COMPUTERVISION_DESCRIBEIMAGE", CVA_ENDPOINT . "describe");

/**
 * Endpoint - Resultado de Operação
 */
define("CVA_COMPUTERVISION_HANDWRITTEN_TEXT_OPERATION_RESULT", CVA_ENDPOINT . "textOperations");

/**
 * Endpoint - Gerar Thumbnail
 */
define("CVA_COMPUTERVISION_GET_THUMBNAIL", CVA_ENDPOINT . "generateThumbnail");

/**
 * Endpoint - Obter modelos da API
 */
define("CVA_COMPUTERVISION_LISTDOMAINSPECIFICMODELS", CVA_ENDPOINT . "models");

/**
 * Endpoint - Reconhecimento
 */
define("CVA_COMPUTERVISION_OPTICAL_CHARACTER_RECOGNITION", CVA_ENDPOINT . "ocr");

/**
 * API da Pesquisa Visual Computacional - Chave 1
 */
define("CVA_KEY_COMPUTERVISION1", "2b52efb5378e4bfb9dac2f1d0b806072");

/**
 * API da Pesquisa Visual Computacional - Chave 2
 */
define("CVA_KEY_COMPUTERVISION2", "685a641c1cfd4d3780a20b12e306e464");

/**
 * API de Detecção de Emoções - Chave 1
 */
define("CVA_KEY_EMOTIONDETECT1", "bb7b062e15d64c4597f9037d159a3b9e");

/**
 * API de Detecção de Emoções - Chave 2
 */
define("CVA_KEY_EMOTIONDETECT2", "91b3337c23b7417dbd3fb038c4af440d");

/**
 * Face API - Chave 1
 */
define("CVA_KEY_FACEAPI1", 'cce14dbfcf624afeae16fd2800505bed');
/**
 * Face API - Chave 2
 */
define("CVA_KEY_FACEAPI2", '0ba31e5759ae419da346f14ec368a5e2');

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

define("CVA_RECOGNIZEDOMAINSPECIFICCONTENT_CELEBRITIES", 'celebrities');

define("CVA_RECOGNIZEDOMAINSPECIFICCONTENT_LANDMARKS", 'landmarks');

define("CVA_FACEDETECT_ATTRIBUTE_AGE", 'age');

define("CVA_FACEDETECT_ATTRIBUTE_GENDER", 'GENDER');

define("CVA_FACEDETECT_ATTRIBUTE_HEADPOSE", 'headPose');

define("CVA_FACEDETECT_ATTRIBUTE_SMILE", 'smile');

define("CVA_FACEDETECT_ATTRIBUTE_FACIAL_HAIR", 'facialHair');

define("CVA_FACEDETECT_ATTRIBUTE_GLASSES", 'glasses');

define("CVA_FACEDETECT_ATTRIBUTE_EMOTION", 'emotion');

define("CVA_FACEDETECT_ATTRIBUTE_HAIR", 'hair');

define("CVA_FACEDETECT_ATTRIBUTE_MAKEUP", 'makeup');

define("CVA_FACEDETECT_ATTRIBUTE_OCCLUSION", 'occlusion');

define("CVA_FACEDETECT_ATTRIBUTE_ACCESSORIES", 'accessories');

define("CVA_FACEDETECT_ATTRIBUTE_BLUR", 'blur');

define("CVA_FACEDETECT_ATTRIBUTE_EXPOSURE", 'exposure');

define("CVA_FACEDETECT_ATTRIBUTE_NOISE", 'noise');

/**
 * Linguagem que será utilizada no OCR.
 * 0  => Auto Detect
 * 1  => Chinese Simplified
 * 2  => Chinese Traditional
 * 3  => Czech
 * 4  => Danish
 * 5  => Dutch
 * 6  => English
 * 7  => Finnish
 * 8  => French
 * 9  => German
 * 10 => Greek
 * 11 => Hungarian
 * 12 => Italian
 * 13 => Japanese
 * 14 => Korean
 * 15 => Norwegian
 * 16 => Polish
 * 17 => Portuguese
 * 18 => Russian
 * 19 => Spanish
 * 20 => Swedish
 * 21 => Turkish
 */
define("CVA_OCR_LANGUAGE", [
    ['AutoDetect', 'unk'],
    ['ChineseSimplified', 'zh-Hans'],
    ['ChineseTraditional', 'zh-Hant'],
    ['Czech', 'cs'],
    ['Danish', 'da'],
    ['Dutch', 'nl'],
    ['English', 'en'],
    ['Finnish', 'fi'],
    ['French', 'fr'],
    ['German', 'de'],
    ['Greek', 'el'],
    ['Hungarian', 'hi'],
    ['Italian', 'it'],
    ['Japanese', 'Ja'],
    ['Korean', 'ko'],
    ['Norwegian', 'nb'],
    ['Polish', 'pl'],
    ['Portuguese', 'pt'],
    ['Russian', 'ru'],
    ['Spanish', 'es'],
    ['Swedish', 'sv'],
    ['Turkish', 'tr']
]);

