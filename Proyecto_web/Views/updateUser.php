<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id = $_POST["id"];
        $name = $_POST ['name'];
        $lastname = $_POST ['lastName'];
        $email = $_POST ['email_address'];
        $finalPassword = $_POST['password'];

        include 'connection.php';

        $sql = "UPDATE users SET user_name='$name', last_name='$lastname', user_email='$email', user_password='$finalPassword' WHERE id_user=$id";

        if (mysqli_query($conexion, $sql)) {
            header("location: usersAdmin.php");
        } else {
            echo "Error al actualizar el usuario: " . mysqli_error($conexion);
        }
        
        mysqli_close($conexion);
    } else {
        echo "Acceso denegado.";
    }
?>