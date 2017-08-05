# Cognitive Services SDK para PHP
[![Microsoft](http://www.lonsys.co.uk/wp-content/uploads/2016/03/microsoft-logo-300x300.jpg)](https://www.microsoft.com/)

Utilize os serviços Cognitivos da Microsoft de forma rápida e eficiente!
##### Visão
* Os mais avançados algoritmos de processamento de imagem ajudam a moderar o conteúdo automaticamente e a criar aplicativos mais personalizados por meio do retorno de análises inteligentes sobre faces, imagens e emoções.
    - API da Pesquisa Visual Computacional
    - API de Detecção Facial
    - Content Moderator 
    - API de Detecção de Emoções
    - API de vídeo
    - Serviço Personalizado de Visão
    - Indexador de Vídeo

##### Fala
* Processando língua falada em seus aplicativos
    - Serviço de Fala Personalizado
    - Speech API do Bing
    - API de Reconhecimento do Locutor
    - API de Tradução de Fala

##### Idioma
* Possibilite que seus aplicativos processem a linguagem natural, avaliem sentimentos e tópicos e aprendam a reconhecer o que os usuários querem.
    - Serviço Inteligente de Reconhecimento Vocal
    - API de Modelo de Linguagem da Web
    - API de Tradução de Texto
    - API de Verificação Ortográfica do Bing
    - API de Análise de Texto
    - API de Análise Linguística 

##### Conhecimento
* Mapeie dados e informações complexas para resolver tarefas como recomendações inteligentes e pesquisa semântica.
    - API de Recomendações
    - Serviço de Exploração de Conhecimento
    - API do Serviço de Inteligência de Vinculação de Entidade
    - API de Conhecimento Acadêmico
    - API do QnA Maker
    - Serviço de Decisão Personalizada 

##### Pesquisar
* Torne seus aplicativos, suas páginas da Web e outras experiências mais inteligentes e mais envolventes com as APIs de Pesquisa do Bing.
    - API de Sugestão Automática do Bing
    - API de Pesquisa de Imagem do Bing
    - API de Pesquisa de Notícias do Bing
    - API de Pesquisa de Vídeo do Bing
    - API de Pesquisa da Web do Bing
    - Pesquisa Personalizada do Bing 
    - API de Pesquisa de Entidade do Bing

> Habilite interações naturais e contextuais com ferramentas que 
> ampliem as experiências dos usuários usando as capacidades da 
> inteligência baseada em computador. Tire proveito de uma coleção 
> sempre crescente de poderosos algoritmos de inteligência artificial 
> que tratam de visão, fala, linguagem e conhecimento.

By: [Microsoft - Serviços Cognitivos](https://azure.microsoft.com/pt-br/services/cognitive-services/) 

# Atenção
Todos os serviços aqui citados são oferecidos pela Microsoft e podem ser visualizados em:
[Microsoft - Serviços Cognitivos](https://azure.microsoft.com/pt-br/services/cognitive-services/), o intuito deste repositório é dar ao desenvolvedor uma base para uso destes serviços, neste caso, em *PHP*.


# Meta
- Disponibilizar todos (ou a maioria) dos serviços nesta ferramenta.
    - Atualmente só implementamos a análise de imagem.


# Como Utilizar

#### Índice
* 1.0 [Análise de Imagem](#análise-de-imagem)
    * 1.1 [Retorno JSON](#retorno-json)
* 2.0 [Descrição de Imagem](#descrição-de-imagem)
    * 2.1 [Retorno JSON](#retorno-json-1)
* 3.0 [Gerado de Thumbnail](#gerador-de-thumbnail)
    * 3.1 [Retorno Binário](#retorno-binário)

### Análise de Imagem
> Obtenha dados sobre o conteúdo visual da imagem.
```php
// Vamos incluir o arquivo.
require_once(realpath(dirname(__FILE__)) . "/core/AnalyzeImage.php");

// Instanciar a classe
$Analyze = new \rqdev\packages\ComputerVisionAPI\AnalyzeImage();

// Constantes disponívieis em: "core/settings.php"
$Analyze->setDetails([CVA_DETAILS_CELEBRITIES, CVA_DETAILS_LANDMARKS]); // Quais detalhes vamos obter
$Analyze->setVisualFeatures([
    CVA_VISUAL_FEATURES_ADULT, CVA_VISUAL_FEATURES_CATEGORIES,
    CVA_VISUAL_FEATURES_COLOR, CVA_VISUAL_FEATURES_DESCRIPTION,
    CVA_VISUAL_FEATURES_DESCRIPTION, CVA_VISUAL_FEATURES_FACES,
    CVA_VISUAL_FEATURES_IMAGE_TYPE, CVA_VISUAL_FEATURES_TAGS
]); // Quais características visuais queremos obter

// Imagem que será analisada:
$imageUrl = 'https://www.exemplo.com/ImagemX.png';
/*
    A Microsoft permite que sejam enviadas imagens por url ou dados binários (octet,form-data), porém
    no momento só permiti o uso de url.
*/

if ($Analyze->Send($imageUrl)) {
    // Se o envio foi um sucesso, teremos o retorno em json, então vamos transforma-lo em array
    // e mostra-lo em Dump.
    var_dump($img->response->toArray());
} else {
    // Caso tenhamos algum erro...
    var_dump($img->error);
}

```

### Retorno JSON:
```json
{
  "categories": [
    {
      "name": "abstract_",
      "score": 0.00390625
    },
    {
      "name": "people_",
      "score": 0.83984375,
      "detail": {
        "celebrities": [
          {
            "name": "Satya Nadella",
            "faceRectangle": {
              "left": 597,
              "top": 162,
              "width": 248,
              "height": 248
            },
            "confidence": 0.999028444
          }
        ],
        "landmarks":[
          {
            "name":"Forbidden City",
            "confidence": 0.9978346
          }
        ]
      }
    }
  ],
  "adult": {
    "isAdultContent": false,
    "isRacyContent": false,
    "adultScore": 0.0934349000453949,
    "racyScore": 0.068613491952419281
  },
  "tags": [
    {
      "name": "person",
      "confidence": 0.98979085683822632
    },
    {
      "name": "man",
      "confidence": 0.94493889808654785
    },
    {
      "name": "outdoor",
      "confidence": 0.938492476940155
    },
    {
      "name": "window",
      "confidence": 0.89513939619064331
    }
  ],
  "description": {
    "tags": [
      "person",
      "man",
      "outdoor",
      "window",
      "glasses"
    ],
    "captions": [
      {
        "text": "Satya Nadella sitting on a bench",
        "confidence": 0.48293603002174407
      }
    ]
  },
  "requestId": "0dbec5ad-a3d3-4f7e-96b4-dfd57efe967d",
  "metadata": {
    "width": 1500,
    "height": 1000,
    "format": "Jpeg"
  },
  "faces": [
    {
      "age": 44,
      "gender": "Male",
      "faceRectangle": {
        "left": 593,
        "top": 160,
        "width": 250,
        "height": 250
      }
    }
  ],
  "color": {
    "dominantColorForeground": "Brown",
    "dominantColorBackground": "Brown",
    "dominantColors": [
      "Brown",
      "Black"
    ],
    "accentColor": "873B59",
    "isBWImg": false
  },
  "imageType": {
    "clipArtType": 0,
    "lineDrawingType": 0
  }
}
```

>Veja a [Documentação Oficial](https://westus.dev.cognitive.microsoft.com/docs/services/56f91f2d778daf23d8ec6739/operations/56f91f2e778daf14a499e1fa)

### Descrição de Imagem
> Obtenha descrições sobre a imagem em linguagem legível. A descrição é baseada em tags de conteúdo, que também podem ser obtidas. Mais de uma descrição pode ser gerada, as descrições são ordenadas pelo seu índice de confiança.
```php
// Vamos incluir o arquivo.
require_once(realpath(dirname(__FILE__)) . "/core/DescribeImage.php");


// Instanciar a classe
$Describe = new \rqdev\packages\ComputerVisionAPI\DescribeImage();

// Quantos retornos deseja? (string)
$Describe->setMaxCandidates("10");

// Imagem que será analisada:
$imageUrl = 'https://www.exemplo.com/ImagemX.png';
/*
    A Microsoft permite que sejam enviadas imagens por url ou dados binários (octet,form-data), porém
    no momento só permiti o uso de url.
*/

if ($Describe->Send($imageUrl)) {
    // Se o envio foi um sucesso, teremos o retorno em json, então vamos transforma-lo em array
    // e mostra-lo em Dump.
    var_dump($Describe->response->toArray());

    // Obtendo Tags
    var_dump($Describe->response->getDescriptionTags());

    // Obtendo descrições
    var_dump($Describe->response->getDescriptionCaptions());

    // Obtendo ID da requisição
    echo $Describe->response->getRequestId();

    // Consulte: core\DescribeImageHelper.php
} else {
    // Caso tenhamos algum erro...
    var_dump($Describe->error);
}

```

### Retorno JSON:
```json
{
  "description": {
    "tags": [
      "person",
      "man",
      "outdoor",
      "window",
      "glasses"
    ],
    "captions": [
      {
        "text": "Satya Nadella sitting on a bench",
        "confidence": 0.48293603002174407
      },
      {
        "text": "Satya Nadella is sitting on a bench",
        "confidence": 0.40037006815422832
      },
      {
        "text": "Satya Nadella sitting in front of a building",
        "confidence": 0.38035155997373377
      }
    ]
  },
  "requestId": "ed2de1c6-fb55-4686-b0da-4da6e05d283f",
  "metadata": {
    "width": 1500,
    "height": 1000,
    "format": "Jpeg"
  }
}
```
>Veja a [Documentação Oficial](https://westus.dev.cognitive.microsoft.com/docs/services/56f91f2d778daf23d8ec6739/operations/56f91f2e778daf14a499e1fe)


### Gerador de Thumbnail
> Esta operação gera uma imagem em miniatura com largura e altura definidas pelo usuário. Por padrão o corte inteligente é utilizado.
```php
// Vamos incluir o arquivo.
require_once(realpath(dirname(__FILE__)) . "/core/GenerateThumbnail.php");


// Instanciar a classe
$Thumbnail = new \rqdev\packages\ComputerVisionAPI\GenerateThumbnail();

// Definindo Largura
$Thumbnail->setWidth(200);

// Definindo Altura
$Thumbnail->setHeigth(200);

// Usar corte inteligente?
$Thumbnail->setSmartCropping(True);


// Imagem que será analisada:
$imageUrl = 'https://www.exemplo.com/ImagemX.png';
/*
    A Microsoft permite que sejam enviadas imagens por url ou dados binários (octet,form-data), porém
    no momento só permiti o uso de url.
*/

if($Thumbnail->Send($imageUrl)) {
	// Se o envio foi um sucesso, teremos o retorno em json, então vamos transforma-lo em uma imagem HTML.
    echo $Thumbnail->response::getHtml();
    // Todas funções disponíveis estão em: "core\GenerateThumbnailHelper.php"
}
else
{
   	var_dump($Thumbnail->error);
}

```
### Retorno Binário:
O retorno dessa requisição trará dados binários da imagem, o mesmo é tratado em toda classe Helper.

>Veja a [Documentação Oficial](https://westus.dev.cognitive.microsoft.com/docs/services/56f91f2d778daf23d8ec6739/operations/56f91f2e778daf14a499e1fb)

### Modelos Disponíveis na API
> Obtenha os modelos suportados pela API Computer Vision.
```php
// Instanciando Classe
$Models = new \rqdev\packages\ComputerVisionAPI\ListDomainSpecificModels();

// Enviando requisição
if($Models->Send())
{
    // Se obtivermos sucesso, veremos um array com todos os models disponíveis na API.
    var_dump($Models->response->toArray());
}
else
{
    var_dump($Models->error);
}
```
### Retorno JSON:
```json
{
  "models": [
    {
      "name": "celebrities",
      "categories": [
        "people_"
      ]
    },
    {
      "name": "landmarks",
      "categories": [
        "building_"
      ]
    }
  ]
}
```
### Em breve mais opções

