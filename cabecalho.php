<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://getbootstrap.com/docs/4.1/examples/navbar-fixed/navbar-top-fixed.css" />
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script> -->
    <title>Palestras</title>
  </head>
  <body style="min-height: auto;">
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="index.php">Palestras</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Todas as Palestras <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="palestra-formulario.php?tipo=incluir">Criar Palestra</a>
          </li>
        </ul>
        <?php 
        // pega a url atual
          $url = $_SERVER['REQUEST_URI'];
          // separamos o tipo de string que queremos identificar
          $termo = "index.php";
          // montamos a expressão regular
          $pattern = '/' . $termo . '/';
          // verificamos se o termo encontrado corresponde caso sim ira exibir o formulario de filtro abaixo
          // fiz essa função com intuito de aparecer o input de filtro somente no index para filtrar as palestras
          if (preg_match($pattern, $url)) {
        ?>
        <form class="form-inline mt-2 mt-md-0" method="get">
          <input class="form-control mr-sm-2" name="palestra" type="text" placeholder="Filtar palestra, paletrante, data..." aria-label="Search" value="<?php if(isset($_GET['palestra'])){ echo $_GET['palestra']; } else{ echo ""; } ?>">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Filtrar</button>
        </form>
        <?php 
          }
        ?>
      </div>
    </nav>
    <div class="container">