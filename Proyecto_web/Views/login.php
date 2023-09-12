<?php
    include 'connection.php';
    session_start(); 

    $name = $_POST['name'];
    $password = $_POST['password'];
    
    $adminQuery = mysqli_query($conexion, "SELECT * FROM adminusers WHERE user_nameAdmin = '$name' AND user_passAdmin = '$password';");

    if ($adminRow = mysqli_fetch_assoc($adminQuery)) {
        $_SESSION['user_id'] = $adminRow['id_user']; 
        $_SESSION['username'] = $name; 
        header("location: indexAdmin.php");
        exit;
    }
    
    $userQuery = mysqli_query($conexion, "SELECT * FROM users WHERE user_name = '$name' AND user_password = '$password';");

    if ($userRow = mysqli_fetch_assoc($userQuery)) {
        $_SESSION['user_id'] = $userRow['id_user']; 
        $_SESSION['username'] = $name; 
        header("location: index.php");
        exit;
    }
    echo "Correo o contraseña incorrecta";
?>


