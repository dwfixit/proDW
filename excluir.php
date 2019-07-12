<?php 
    session_start();
    require_once("incluir/conexao.php");


    if(!isset($_SESSION["user_name"])){
        header("Location: login.php");
    }

    $login = $_SESSION["user_name"];

    $consulta_usuario = "select * from cliente ";
    $consulta_usuario .= "where login = '$login';";
    $consulta_usuario = mysqli_query($conecta, $consulta_usuario);
    if(!$consulta_usuario){
        die("Falha na consulta");
    }
    $result_consulta = mysqli_fetch_assoc($consulta_usuario);

    echo $result_consulta["login"];
    /*$delete_arquivo = unlink($result_consulta["caminho_foto"]);
    if(!$delete_arquivo){
        die("Falha na exclusao");
    }

    $query_delete = "delete from cliente ";
    $query_delete .= "where login = {$login};";
    $query_delete = mysqli_query($conecta, $query_delete);
    unset($_SESSION["user_name"]);
    */mysqli_close($conecta);
    //header("Location: index.html");

?>