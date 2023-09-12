<?php
    $server = "127.0.0.1";
    $database = "suplements";
    $username = "root";
    $password = "";

    $conexion = mysqli_connect("127.0.0.1", "root", "", "suplements");

    if(!$conexion) {
        echo "No exitosa";
    } else {
        echo "";
    }
?>