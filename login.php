<?php require_once("incluir/conexao.php");?>

<?php 
  session_start();
  if(isset($_POST["usuario"])){
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    $login = "select * from cliente where login = '{$usuario}' and senha = '{$senha}';";

    $acesso = mysqli_query($conecta, $login);
    if(!$acesso){
      die("Erro na consulta");
    }

    $informacao = mysqli_fetch_assoc($acesso);
    if(empty($informacao)){
      $mensagem = "Login sem sucesso";
    } else{
      $_SESSION["user_name"] = $informacao["login"];
      header("location: perfilCliente.php");
    }
    
  }
?>


<html lang="pt">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="imagens/favicon-32x32.png"> <!--MUDANDO O ICONE QUE APARECE AO ABRIR O SITE-->
        
        <title>Login | fixIt</title>
        
        <!-- Principal CSS do Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <link href="css/login.css" rel="stylesheet">
        <link href="css/geral.css" rel="stylesheet">


    </head>
    
    <body class="text-center">

        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
                <a href="home.html"><img src="imagens/favicon-32x32.png"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                      <a class="nav-link" href="home.html">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Cadastrar
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="cadastrocliente.html">Cadastrar como Cliente</a>
                          <a class="dropdown-item" href="cadastroprestador.html">Cadastrar como Prestador</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="ajuda.html">Estou com dúvida</a>
                        </div>
                      </li>
                    <li class="nav-item active">
                      <a class="nav-link" href="login.php">Login</a>
                    </li>
                   
                  </ul>
              <form class="form-inline mt-2 mt-md-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Pesquisar" aria-label="Procurar">
                <button class="btn btn-outline btcolor_outline my-2 my-sm-0" type="submit">Pesquisar</button>
              </form>
            </div>
          </nav>
        </header>

        <form action="login.php" method="POST" class="form-signin">

            <img class="mb-4" src="imagens/logo.png" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Login</h1>
            <label for="inputEmail" class="sr-only">Usuário</label>
            <input type="text" id="inputEmail" class="form-control" placeholder="Usuário" required autofocus name="usuario">
            <label for="inputPassword" class="sr-only">Senha</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Senha" required name="senha">
            <button class="btn btn-lg btn-block btcolor" type="submit">Entrar</button>
            <?php 
              if(isset($mensagem)){
                echo "<p>".$mensagem."</p>";
              }
            ?>
            <a href="ajuda.html" button class="btn btn-outline btn-sm mt-2 btcolor_outline">Não sou cadastrado</a>
            <a href="esquecisenha.html" button class="btn btn-outline btn-sm mt-2 btcolor_outline">Esqueci senha</a>

        </form>

        






        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

        <script>
            window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')Entrar
          </script>
        <script src="https://getbootstrap.com.br/docs/4.1/assets/js/vendor/popper.min.js"></script>
        <script src="https://getbootstrap.com.br/docs/4.1/dist/js/bootstrap.min.js"></script>
       
        <script src="https://getbootstrap.com.br/docs/4.1/assets/js/vendor/holder.min.js"></script>
      
    
    </body>

</html>

<?php mysqli_close($conecta); ?>