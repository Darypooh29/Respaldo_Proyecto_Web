<?php
    include 'connection.php';

    $name = $_POST ['name'];
    $lastname = $_POST ['last_name'];
    $email = $_POST ['email_address'];
    $password = $_POST ['password'];

    $sql = mysqli_query($conexion, "INSERT INTO users(id_user, user_name, last_name, user_email, user_password) values (0, '$name', '$lastname', '$email', '$password')");
    if($sql){
        header("location: usersAdmin.php");
    }else{
        echo "Usuario no agregado";
    }
?>