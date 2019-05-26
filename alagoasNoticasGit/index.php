<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alagoas notícias</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>      
    <style>
        body{
            background-image:url("./img/fundo.jpg");
        }
        .title{
            padding:2%;
            text-align: center;
        }
        .conteudo{
            font-size:20px;
            text-align: justify;
            margin-left:10%;
            margin-right:10%;
        }
        .brand-logo img {
          height: 64px;
        }
        .content-head__title{
          font-size:26px;
        }
        .icon{
            width:24px;
            height:24px;
        }
    </style>

</head>
<body>
  <div>
    <ul id="dropdown1" class="dropdown-content">
      <li><a href="index.php">Início</a></li>
      <li><a href="./paginas/noticias.php">Notícias publicadas</a></li>
      <li><a href="./paginas/historia.php">História</a></li>
      <li><a href="./paginas/custoVida.php">Custo de vida</a></li>
      
    </ul>
    <nav>
      <div class="nav-wrapper">
        <a href="#!" class="brand-logo"> <img src="./img/ying.svg" alt=""></a>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
        <li><a href="index.php">Início</a></li>
          <li><a href="./paginas/noticias.php">Notícias publicadas</a></li>
          <li><a href="./paginas/historia.php">História</a></li>
          <li><a href="./paginas/custoVida.php">Custo de vida</a></li>
          
        </ul>
      </div>
    </nav>
    <ul class="sidenav" id="mobile-demo">
      <li><a href="index.php">Início</a></li>
      <li><a href="./paginas/noticias.php">Notícias publicadas</a></li>
      <li><a href="./paginas/historia.php">História</a></li>
      <li><a href="./paginas/custoVida.php">Custo de vida</a></li>
      
    </ul>
  </div>
  <div class="slider">
    <ul class="slides">
      <li>
        <img src="./img/alagoas1.jpg"> <!-- random image -->
        <div class="caption center-align">
          <h3>Seja bem vindo</h3>
          <h5 class="light grey-text text-lighten-3">Aqui você tem notícias diárias sobre a sua cidade</h5>
        </div>
      </li>
      <li>
        <img src="./img/alagoas2.jpg"> <!-- random image -->
        <div class="caption left-align">
          <h3>Custo de vida da sua cidade</h3>
        </div>
      </li>
      <li>
        <img src="./img/alagoas3.jpg"> <!-- random image -->
        <div class="caption left-align">
          <h3>História da sua cidade</h3>
        </div>
      </li>
    </ul>
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.slider').slider({full_width: true});
    });
    $(document).ready(function(){
        $('.sidenav').sidenav();
      });
  </script>

<?php
  function estaNaLista($lista,$elemento){
    foreach($lista as $item){
      if ($item==$elemento){
        return true;
      }
    }
    return false;
  }
  function imprime_lista($lista){
    foreach ($lista as $item){
      echo $item.'<br>';
    }
  }
  function buscaTopico($dominio,$palavraChave){
    $doc = phpQuery::newDocumentFile($dominio);
    $tamanhoDominio = strlen($dominio)+1;
    
    $subdomios_lista = [];
    $urls = $doc['a'];
    foreach ($urls as $url) {
      $subdomio_elemento = pq($url)->attr('href');
      
      $subdomioFragmentado = explode("/",$subdomio_elemento);
      if (estaNaLista($subdomioFragmentado,$palavraChave[0]) && estaNaLista($subdomioFragmentado,$palavraChave[1]) ){
        array_push($subdomios_lista,$subdomio_elemento);
      }
    }
    return $subdomios_lista;
  }
  function main($dominio="https://g1.globo.com/al/alagoas/",$palavrasChave=["alagoas","noticia"]){
    $lista_sites = buscaTopico($dominio,$palavrasChave);
    
    $tamanho_lista = count( $lista_sites)-1;
    $numeroSorteado = $tamanho_lista-rand(0,$tamanho_lista);
    $site_escolhido = $lista_sites[$numeroSorteado];
    return $site_escolhido;
  }

    include_once './phpQuery/phpQuery/phpQuery.php';

    phpQuery::newDocumentFileHTML(main());
    $conteudo = pq('.content-text');
    $time = pq('time');

    $titulo  = pq('.content-head__title');
    
    echo '<div class="conteudo">';
    echo '<h3>'.$titulo.'</h3>';
    $texto = '';
    foreach ($conteudo as $paragrafo){
        $texto = pq($paragrafo);
        // echo '<script>console.log("'.strip_tags($texto).'");</script>';
        if (trim(strip_tags($texto))=="Veja mais notícias da região no G1 Alagoas"){}
        else{
            echo '<div> <p >'.$texto.'</p></div>';
        }
    }
    echo $time;
    echo '</div><br><br><br>';    
    ?>
    <footer class="page-footer">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                <h5 class="white-text">Informações do desenvolvedor</h5>
                <p class="grey-text text-lighten-4">Este site foi desenvolvido por Celso Leandro Nascimento Vasconcelos. Todas as informações aqui contidas são totalmente véridicas.</p>
                </div>
                <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Redes sociais do desenvolvedor</h5>
                <ul>
                    <li><a target="_blank" class="grey-text text-lighten-3" href="https://www.facebook.com/celsolnv">
                        <img class="icon" src="./icon/facebook.svg" alt="facebook">
                        <span style="font-size:24px;">Facebook</span>
                    </a></li>
                    <li><a target="_blank" class="grey-text text-lighten-3" href="https://www.instagram.com/celsolv/">
                        <img class="icon" src="./icon/instagram.svg" alt="instagram">
                        <span style="font-size:24px;">Instagram</span>
                    </a></li>
                    <li><a target="_blank" class="grey-text text-lighten-3" href="https://www.linkedin.com/in/celso-vasconcelos-b3a793143/">
                        <img class="icon" src="./icon/linkedin.svg" alt="linkedin">
                        <span style="font-size:24px;">Linkedin</span>
                    </a></li>
                    <li><a target="_blank" class="grey-text text-lighten-3" href="https://github.com/celsops">
                        <img class="icon" src="./icon/github.svg" alt="github">
                        <span style="font-size:24px;">Github</span>
                    </a></li>
                </ul>
                </div>
            </div>
        </div>
</footer>
            
</body>
</html>    	