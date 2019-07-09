<?php
    $conecta = mysqli_connect("localhost","root","1234","fixit");
    
    if(mysqli_connect_errno()){
        die("Conexão Fail: " . mysqli_connect_errno());
    }

?>    