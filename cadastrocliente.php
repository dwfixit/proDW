<?php 
    require_once("incluir/conexao.php");
    require_once("incluir/funcoes.php");

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
    

    //echo $nome ."<br>".$sobrenome ."<br>".$login ."<br>".$senha ."<br>".$email ."<br>".$endereco ."<br>".$bairro ."<br>".$estado ."<br>".$cidade."<br>".$cep ."<br>".$telefone ."<br>".$celular ."<br>";


    $inserir = "INSERT INTO cliente (login, senha, nome, sobrenome, email, endereco, bairro, estado, cidade, cep, celular, telefone, caminho_foto) VALUES ";
    
    if(!empty($_POST["telefone"])){
        $telefone = $_POST["telefone"];
        $inserir .= "('$login', '$senha', '$nome', '$sobrenome', '$email', '$endereco', '$bairro', '$estado', '$cidade', '$cep', '$celular', '$telefone', ";

    }else{  
        $inserir .= "('$login', '$senha', '$nome', '$sobrenome', '$email', '$endereco', '$bairro', '$estado', '$cidade', '$cep', '$celular', NULL, ";
    }

    if($_FILES["fotoperfil"]["error"] != 0){
        $inserir .= "'fotos_perfil/padrao.png');";
    } else{
        $resultado = publicarImagem($_FILES["fotoperfil"]);
        $inserir .= "'$resultado[1]');";
    }

    echo $inserir;

    $op_inserir = mysqli_query($conecta, $inserir);
    if(!$op_inserir){
        die("Erro na inclusao");    
    }
    
    
    header("location: login.php");
    mysqli_close($conecta);
?>