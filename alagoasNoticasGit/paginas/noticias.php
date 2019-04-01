<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Notícias de Alagoas</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
            
  <style>
    body{
        background-image:url("../img/fundo.jpg");
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
  </style>
</head>
<body>
  <div>
    <ul id="dropdown1" class="dropdown-content">
      <li><a href="../index.php">Início</a></li>
      <li><a href="./">Notícias publicadas</a></li>
      <li><a href="./historia.php">História</a></li>            
      <li><a href="./custoVida.php">Custo de vida</a></li>
      
    </ul>
    <nav>
      <div class="nav-wrapper">
        <a href="/" class="brand-logo"> <img src="../img/ying.svg"></a>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
          <li><a href="../index.php">Início</a></li>
          <li><a href="./">Notícias publicadas</a></li>
          <li><a href="./historia.php">História</a></li>
          <li><a href="./custoVida.php">Custo de vida</a></li>
            
        </ul>
      </div>
    </nav>
    <ul class="sidenav" id="mobile-demo">
      <li><a href="../index.php">Início</a></li>
      <li><a href="./">Notícias publicadas</a></li>
      <li><a href="./historia.php">Histórias</a></li>
      <li><a href="./custoVida.php">Custo de vida</a></li>
      
    </ul>
    <script>
      $(document).ready(function(){
        $('.sidenav').sidenav();
      });
    </script> 
    <?php
      include_once '../phpQuery/phpQuery/phpQuery.php';
      if ( isset($_GET['url']) && $_GET['url']!=""){
      
        $dominio = $_GET["url"];
        phpQuery::newDocumentFileHTML($dominio);
        $titulo  = pq('.content-head__title');
        $conteudo = pq('.content-text');
        $time = pq('.content-publication-data');
  
        echo '<div class="conteudo">'.$titulo.$conteudo.$time. '</div>';
      }
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
            if (!(in_array($subdomio_elemento,$subdomios_lista))){
              array_push($subdomios_lista,$subdomio_elemento);
            }  
          }
        }
        return $subdomios_lista;
      }
      $dominio = "https://g1.globo.com/al/alagoas/";
      $palavrasChave = ["alagoas","noticia"];
      $lista_sites = buscaTopico($dominio,$palavrasChave);
      
      echo "<div>";
      foreach ($lista_sites as $url) {
        phpQuery::newDocumentFileHTML($url);
        echo "<a href='./noticias.php?url=".$url."'>".  pq('.content-head__title')."</a>";
      }
      echo "</div>";
      
    ?>
</body>
</html> 