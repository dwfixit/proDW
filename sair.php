<?php 
    session_start();
    unset($_SESSION["user_name"]);
    header("location: https://dwfixit.000webhostapp.com/index.html");
?>