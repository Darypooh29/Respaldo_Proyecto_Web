<?php
    include 'connection.php';

    $name = $_POST ['name'];
    $lastname = $_POST ['last_name'];
    $email = $_POST ['email_address'];
    $phone = $_POST ['phone'];
    $gender = $_POST ['gender'];
    $password = $_POST ['password'];

    $sql = mysqli_query($conexion, "INSERT INTO users(id_user, user_name, last_name, user_email, phone, gender, user_password) values (0, '$name', '$lastname', '$email', '$phone', '$gender', '$password')");
    if($sql){
        header("location: login.html");
    }else{
        echo "Usuario no agregado";
    }
?>