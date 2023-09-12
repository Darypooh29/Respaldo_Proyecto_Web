<?php
    include 'connection.php';
    session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Dary suplements administrador</title>
        <link rel="stylesheet" href="../Styles/modify.css">
    </head>
    <body>
        <div class="main-container">
            <header>
                <nav class="navBar">
                    <div class="logo"><a href="#">Suplementos Darykiller</a>
                    </div>
                    <ul class="options">    
                        <li><a class="link-home" href="../Views/indexAdmin.php">Administración</a></li>
                    </ul>
                    <div>
                        <a href="../Views/login.html" class="action_btn">Inicio de sesion</a>
                        <div class="toggle_btn">
                            <i class="fa-solid fa-bars"></i>
                        </div>
                        <button>
                            <i class="fa-solid fa-cart-shopping"></i>
                        </button>
                    </div>
                </nav>
                <div class="dropdown_menu">
                    <li><a href="../Views/login.html" class="action_btn" id="boton">Inicio de sesion</a></li>
                </div>
            </header>
            <?php
                if (isset($_GET["id"])) {
                    $id = $_GET["id"];
                    
                    include 'connection.php';

                    $sql = "SELECT * FROM users WHERE id_user = $id";
                    $result = $conexion->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $name = $row["user_name"];
                        $lastName = $row["last_name"];
                        $email = $row["user_email"];
                        $password = $row["user_password"];    

                        echo "<div class='mainContainer'>";
                        echo "<form class='formContent' action='updateUser.php' method='POST'>";
                            echo "<h3 align='center'>Editar</h3>";
                            echo "<input type='hidden' name='id' value='$id' />";
                            echo "Nombre: <input type='text' name='name' value='$name' /><br>";
                            echo "Apellidos: <input type='text' name='lastName' value='$lastName' /><br>";
                            echo "Correo electrónico: <input type='email' name='email_address' value='$email' /><br>";
                            echo "Contraseña: <input type='password' name='password' value='$password' /><br>";
                            echo "<input type='submit' value='Guardar cambios' />";
                            echo "</form>";
                        echo "</div>";
                    } else {
                        echo "No se encontró el usuario.";
                    }
                    
                    mysqli_close($conexion);
                }
            ?>
    </body>
</html>