<?php 
    require_once("incluir/conexao.php");
    require_once("incluir/funcoes.php");
?>

<?php
    session_start();
    $usuario = $_SESSION["user_name"];
    if (!isset($_SESSION["user_name"])){
        Header("Location: login.php");
    }
    $consulta = "SELECT * from cliente WHERE login = '{$usuario}';";
    
    $dados = mysqli_query($conecta, $consulta);
    if(!$dados){
        die("Falha na consulta");
    }

    $dados = mysqli_fetch_assoc($dados);

    //echo $dados["nome"] ."<br>".$dados["sobrenome"] ."<br>".$dados["login"] ."<br>".$dados["senha"] ."<br>".$dados["email"] ."<br>".$dados["endereco"] ."<br>".$dados["bairro"] ."<br>".$dados["estado"] ."<br>".$dados["cidade"]."<br>".$dados["cep"] ."<br>".$dados["telefone"] ."<br>".$dados["celular"] ."<br>";

?>

<!DOCTYPE html>
<html lang="br">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="imagens/favicon-32x32.png">  
    <title>Perfil | fixIt</title>
    <link href="css/perfilusuario.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
    <link href="css/geral.css" rel="stylesheet">
    <link href="css/perfilusuario.css" rel="stylesheet">
</head>
<body>
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

                    <li class="nav-item active">
                      <a class="nav-link" href="perfilCliente.php">Meu Perfil</a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="sair.php">Sair</a>
                    </li>
                  </ul>
              <form class="form-inline mt-2 mt-md-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Pesquisar" aria-label="Procurar">
                <button class="btn btn-outline btcolor_outline my-2 my-sm-0" type="submit">Pesquisar</button>
              </form>
            </div>
          </nav>
        </header>

    <div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="<?php echo $dados["caminho_foto"]?>" alt=""/>
                            <div class="file btn btn-lg btn-primary">
                                Mudar Foto
                                <input type="file" name="fotoperfil"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                        <?php echo $dados["nome"]." ". $dados["sobrenome"];?>
                                    </h5>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Sobre</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" class="btn btcolor" name="btnAddMore" value="Editar Perfil"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>ID Usuário</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $dados["login"];?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Nome</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $dados["nome"]." ". $dados["sobrenome"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $dados["email"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Telefone Fixo</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php 
                                                    if(is_null($dados["telefone"])){
                                                        echo "Não cadastrado";
                                                    }else{
                                                        echo $dados["telefone"];
                                                    }
                                                ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Celular</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $dados["celular"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Endereço</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $dados["endereco"];?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Bairro</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $dados["bairro"];?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Cidade</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $dados["cidade"];?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Estado</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $dados["estado"];?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>CEP</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $dados["cep"];?></p>
                                            </div>
                                        </div>
 
                            </div>
                        </div>
                    </div>
            </div>
        </form>           
    </div>  
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>  
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
      </script>
    <script src="https://getbootstrap.com.br/docs/4.1/assets/js/vendor/popper.min.js"></script>
    <script src="https://getbootstrap.com.br/docs/4.1/dist/js/bootstrap.min.js"></script>
   
    <script src="https://getbootstrap.com.br/docs/4.1/assets/js/vendor/holder.min.js"></script>
  

    <svg xmlns="http://www.w3.org/2000/svg" width="500" height="500" viewBox="0 0 500 500" preserveAspectRatio="none" style="display: none; visibility: hidden; position: absolute; top: -100%; left: -100%;"><defs>
    </defs>
    <text x="0" y="25" style="font-weight:bold;font-size:25pt;font-family:Arial, Helvetica, Open Sans, sans-serif">500x500</text>
    </svg>
</body>
</html>

<?php mysqli_close($conecta); ?>