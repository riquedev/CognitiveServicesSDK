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

# Código de Conduta
Desenvolvedores que usam os Serviços Cognitivos, incluindo esta amostra,  deverão seguir o código de conduta do "Developer Code of Conduct for Microsoft Cognitive Services", que pode ser encontrado em: [http://go.microsoft.com/fwlink/?LinkId=698895](http://go.microsoft.com/fwlink/?LinkId=698895).

# Ferramentas Disponíveis & Como Utilizar

#### Índice
* 1.0 [Análise de Imagem](</examples/AnalyzeImage/>)
    > Esta operação extrai um rico conjunto de recursos visuais com base no conteúdo da imagem. 
    * 1.1 [Como Utilizar](</examples/AnalyzeImage/index.php>)
    * 1.2 [Retorno JSON](</examples/AnalyzeImage/response.json>)
* 2.0 [Descrição de Imagem](</examples/DescribeImage/>)
    > Esta operação gera uma descrição de uma imagem em linguagem legível para humanos com frases completas. A descrição é baseada em uma coleção de tags de conteúdo, que também são devolvidos pela operação. Mais de uma descrição pode ser gerada para cada imagem. As descrições são ordenadas pelo seu índice de confiança. Todas as descrições estão em inglês. 
    * 2.1 [Como Utilizar](</examples/DescribeImage/index.php>)
    * 2.2 [Retorno JSON](</examples/DescribeImage/response.json>)
* 3.0 [Gerador de Thumbnail](</examples/GenerateThumbnail/>)
    > Esta operação gera uma imagem em miniatura com a largura e a altura especificadas pelo usuário. Por padrão, o serviço analisa a imagem, identifica a região de interesse (ROI) e gera coordenadas de corte inteligentes com base no ROI. 
    * 3.1 [Como Utilizar](</examples/GenerateThumbnail/index.php>)
    * 3.2 [Retorno Binário](</examples/GenerateThumbnail/download.jfif>)
* 4.0 [Modelos Disponíveis](</examples/ListDomainSpecificModels/>)
    > Esta operação retorna a lista de modelos específicos de domínio suportados pela API Computer Vision.
    * 4.1 [Como Utilizar](</examples/ListDomainSpecificModels/index.php>)
    * 4.2 [Retorno JSON](</examples/ListDomainSpecificModels/response.json>)
* 5.0 [Reconhecimento Óptico de Caracteres](</examples/OpticalCharacterRecognition/>)
    > O reconhecimento óptico de caracteres (OCR) detecta texto em uma imagem e extrai os caracteres reconhecidos em um fluxo de caracteres utilizável pela máquina.
    * 5.1 [Como Utilizar](</examples/OpticalCharacterRecognition/index.php>)
    * 5.2 [Retorno JSON](</examples/OpticalCharacterRecognition/response.json>)
* 6.0 [Reconhecimento de Conteúdo Específico](</examples/RecognizeDomainSpecificContent/>)
    > Esta operação reconhece conteúdo dentro de uma imagem aplicando um modelo específico de domínio. 
    * 6.1 [Como Utilizar](</examples/RecognizeDomainSpecificContent/index.php>)
    * 6.2 [Retorno JSON](</examples/RecognizeDomainSpecificContent/response.json>)
* 7.0 [Tag Image](</examples/TagImage/>)
    > Esta operação gera uma lista de palavras ou tags que são relevantes para o conteúdo da imagem fornecida. O Computer Vision API pode retornar tags com base em objetos, seres vivos, cenários ou ações encontradas em imagens. Ao contrário das categorias, as tags não são organizadas de acordo com um sistema de classificação hierárquico, mas correspondem ao conteúdo da imagem. As tags podem conter dicas para evitar a ambiguidade ou fornecer contexto, por exemplo, a tag "violão" pode ser acompanhada da sugestão "instrumento musical". Todas as tags estão em inglês. 
    * 7.1 [Como Utilizar](</examples/TagImage/index.php>)
    * 7.2 [Retorno JSON](</examples/TagImage/response.json>)

### Em breve mais opções

