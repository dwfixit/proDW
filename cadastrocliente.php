<?php 
    require_once("incluir/conexao.php");
    require_once("incluir/funcoes.php");

    if(isset($_POST["cpf"])){
        $cpf = $_POST["cpf"];
        $login = $_POST["login"];
        $result_login = "select login, cpf from cliente ";
        $result_login .= "where login = '$login' or cpf = '$cpf';";
        //echo $result_login;
        $result_login = mysqli_query($conecta, $result_login);
        $erro_login = false;
        $erro_senha = false;
        $erro_cpf = false;
        if(!$result_login){
            die("Falha na consulta ao banco");
        }
        //$dados = mysqli_fetch_assoc($result_login);
        //print_r($dados);
        while($linha = mysqli_fetch_assoc($result_login)){
            if($linha["login"] == $_POST["login"]){
                $erro_login = true;
            }
            if($linha["cpf"] == $_POST["cpf"]){
                $erro_login = true;
            }
        }
        if(!validaCPF($_POST["cpf"])){
            $erro_cpf = true;
        }
        if(strlen($_POST["senha"]) < 8){
            $erro_senha = true;
        }

        if(!$erro_cpf && !$erro_login && !$erro_senha){
            $cpf = $_POST["cpf"];
            $nome = $_POST["nome"];
            $sobrenome = $_POST["sobrenome"];
            $login = $_POST["login"];
            $senha = $_POST["senha"];
            $email = $_POST["email"];
            $endereco = $_POST["endereco"];
            $bairro = $_POST["bairro"];
            $estado = $_POST["estado"];
            $cidade = $_POST["cidade"];
            $cep = $_POST["cep"];
            $celular = $_POST["celular"];
            

            //echo $cpf ."<br>".$nome ."<br>".$sobrenome ."<br>".$login ."<br>".$senha ."<br>".$email ."<br>".$endereco ."<br>".$bairro ."<br>".$estado ."<br>".$cidade."<br>".$cep ."<br>".$telefone ."<br>".$celular ."<br>";


            $inserir = "INSERT INTO cliente (cpf, login, senha, nome, sobrenome, email, endereco, bairro, estado, cidade, cep, celular, telefone, caminho_foto) VALUES ";
            
            if(!empty($_POST["telefone"])){
                $telefone = $_POST["telefone"];
                $inserir .= "('$cpf', '$login', '$senha', '$nome', '$sobrenome', '$email', '$endereco', '$bairro', '$estado', '$cidade', '$cep', '$celular', '$telefone', ";

            }else{  
                $inserir .= "('$cpf', '$login', '$senha', '$nome', '$sobrenome', '$email', '$endereco', '$bairro', '$estado', '$cidade', '$cep', '$celular', NULL, ";
            }

            if($_FILES["fotoperfil"]["error"] != 0){
                $inserir .= "'fotos_perfil/padrao.png');";
            } else{
                $resultado = publicarImagem($_FILES["fotoperfil"]);
                $inserir .= "'$resultado[1]');";
            }

            //echo $inserir;

            $op_inserir = mysqli_query($conecta, $inserir);
            if(!$op_inserir){
                die("Erro na inclusao");    
            }
            
            mysqli_close($conecta);
            header("location: login.php");
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v3.8.5">
  <link rel="icon" href="imagens/favicon-32x32.png">
  <title>Cadastro Cliente | fixIt</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/checkout/">

  <!-- Bootstrap core CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css?fbclid=IwAR3E6jvID8yvYH0G7TbkGKWK21EeDPBn-y0bVAV8SHwdAacAgoozS--bNo4" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link href="css/geral.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }
    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <!-- Custom styles for this template -->
  <link href="form-validation.css" rel="stylesheet">
</head>
<body class="bg-light">
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a href="index.html"><img src="imagens/favicon-32x32.png"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Cadastrar
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="cadastrocliente.php">Cadastrar como Cliente</a>
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

    <br><br><br>
  <div class="container">
<div class="py-5 text-center">
  <img class="d-block mx-auto mb-4" src="imagens/logo.png" alt="" width="72" height="72">
  <h2>Cadastro</h2>
  <p class="lead">Para começar a conhecer profissionais de qualidade, cadastre-se. É grátis!</p>
</div>
  <div class="col-md-12 order-md-1">
    <form action="cadastrocliente.php" method="POST" class="needs-validation"  enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="firstName">Nome</label>
          <input type="text" class="form-control" id="firstName" placeholder="" required name="nome">
        </div>
        <div class="col-md-6 mb-3">
          <label for="lastName">Sobrenome</label>
          <input type="text" class="form-control" id="lastName" placeholder="" required name="sobrenome">
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="firstName">Nome de usuário</label>
          <input type="text" class="form-control" id="username" placeholder="Escolha um nome de usuário para fazer o login" required name="login">
            
                <?php 
                    if(isset($erro_login)){
                        if($erro_login){
                        echo "<p class='btn btn-outline-danger'> login já cadastrado, informe outro login</p>";
                    }}    
                ?>
            
        </div>
        <div class="col-md-6 mb-3">
          <label for="lastName">Senha</label>
          <input type="password" class="form-control" id="passw" placeholder="Escolha uma senha de pelo menos 8 dígitos" required name="senha" maxlength="20">
            <?php 
                if(isset($erro_senha)){
                    if($erro_senha){
                        echo "<p class='btn btn-outline-danger'>Senha não tem o tamanho minimo</p>";
                }}
            ?>
        </div>
      </div>

      <div class="mb-3">
        <label for="cpf">CPF</label>
        <input type="text" class="form-control" id="cpf" maxlength="11" placeholder="11111111111" name="cpf" required>
        
            <?php 
                if(isset($erro_cpf)){
                    if($erro_cpf){
                        echo "<p class='btn btn-outline-danger'>CPF inválido ou já cadastrado</p>";
                }}
            ?>
      </div>

      <div class="mb-3">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" placeholder="usuario@exemplo.com" name="email" required>
      </div>

      <div class="mb-3">
          <label for="address">Endereço Completo</label>
          <input type="text" class="form-control" id="address" required name="endereco">
        </div>

      <div class="mb-3">
        <label for="address">Bairro</label>
        <input type="text" class="form-control" id="address" required name="bairro">
      </div>

      <div class="row">
        
        <div class="col-md-4 mb-3">
          <label for="state">Estado</label>
          <input type="text" class="form-control" id="estado" required name="estado" maxlenght="20">
        </div>
        <div class="col-md-5 mb-3">
            <label for="country">Cidade</label>
            <input type="text" class="form-control" id="cidade" required name="cidade"/>
          </div>
        <div class="col-md-3 mb-3">
          <label for="zip">CEP</label>
          <input type="text" class="form-control" id="zip" placeholder="" required name="cep" maxlength="8"/>
          
        </div>
      </div>
      <div class="row">
          <div class="col-md-6 mb-3">
            <label for="telefone">Telefone</label>
            <input type="text" class="form-control" id="telefone" placeholder="6233333333" name="telefone" maxlength="11">
          </div>
          <div class="col-md-6 mb-3">
            <label for="celular">Celular</label>
            <input type="text" class="form-control" id="celular" placeholder="62999999999" required name="celular" maxlength="11">
          </div>
      </div>
      
      <div class="row">
        <div class="col-md-3 mb-3">
          <label for="fotoperfil">Insira uma foto de perfil</label>
          <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
          <input type="file" name="fotoperfil" id="fotoperfil">
        </div>
      </div>

      <br>
      <button class="btn btcolor btn-lg btn-block" type="submit" name="botao">Cadastrar</button>
    </form>
  </div>
</div>
<br>
<hr class="featurette-divider">
          <!-- FOOTER -->
          <footer class="container">
              <p class="float-right"><a href="#">Voltar ao topo</a></p>
              <p>© Projeto de PW, 2019/01  · <a href="#">Privacidade</a> · <a href="#">Termos</a></p>
            </footer>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
      <script src="form-validation.js"></script>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script>
            window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
          </script>
        <script src="https://getbootstrap.com.br/docs/4.1/assets/js/vendor/popper.min.js"></script>
        <script src="https://getbootstrap.com.br/docs/4.1/dist/js/bootstrap.min.js"></script>
       
        <script src="https://getbootstrap.com.br/docs/4.1/assets/js/vendor/holder.min.js"></script>
      
    
    <svg xmlns="http://www.w3.org/2000/svg" width="500" height="500" viewBox="0 0 500 500" preserveAspectRatio="none" style="display: none; visibility: hidden; position: absolute; top: -100%; left: -100%;"><defs>
      <style type="text/css">
      </style>
    </defs>
    <text x="0" y="25" style="font-weight:bold;font-size:25pt;font-family:Arial, Helvetica, Open Sans, sans-serif">500x500</text>
  </svg>

</body>
</html>
<?php mysqli_close($conecta);?>