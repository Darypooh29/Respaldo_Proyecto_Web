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
        <link rel="stylesheet" href="../Styles/usersAdmin.css">
    </head>
    <body>
        <div class="main-container">
            <header>
                <nav class="navBar">
                    <div class="logo"><a href="#">Suplementos Darykiller</a></div>

                    <ul class="options">    
                        <li><a class="link-home" href="../Views/indexAdmin.php">Administración</a></li>
                    </ul>

                    <div>
                        <?php
                            // Verificar si la sesión está iniciada
                            if (isset($_SESSION['username'])) {
                                $username = $_SESSION['username'];
                                echo "<span>$username</span>";
                                echo '<a href="logout.php" class="action_btn">Cerrar sesión</a>';
                            } else {
                                echo '<a href="../Views/login.html" class="action_btn">Inicio de sesión</a>';
                            }
                        ?>

                        <div class="toggle_btn">
                            <i class="fa-solid fa-bars"></i>
                        </div>

                        <?php
                        if (isset($_SESSION['username'])) {
                            $username = $_SESSION['username'];
                            echo "<button onclick=\"window.location.href='car.php'\"><i class=\"fa-solid fa-cart-shopping\"></i></button>";
                        } else {
                            echo "<button onclick=\"window.location.href='../Views/login.html'\"><i class=\"fa-solid fa-cart-shopping\"></i></button>";
                        }
                        ?>
                    </div>
                </nav>
                <div class="dropdown_menu">
                    <li><a href="../Views/login.html" class="action_btn" id="boton">Inicio de sesion</a></li>
                </div>
            </header>
            <!-- Here is the table with the info from DB -->
            <section class="main-register">
                <div class="usersContent">
                    <div class="tableContainer">
                        <div class="tableHeader">
                            <div class="buttonContainer">
                                <button id="openModal">
                                    Agregar
                                </button>
                            </div> 
                            <div class="searchContainer">
                                <form class="searchForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <div>
                                        <input type="text" name="userName" placeholder="Ingrese el nombre del usuario">
                                    </div>
                                    <div>
                                        <button type="submit" id = "login-button" ><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div> 
                    
                        <?php
                            // Verificar si se ha enviado el formulario de búsqueda
                            if (isset($_POST['userName'])) {
                                $userName = $_POST['userName'];

                                $sql = "SELECT * FROM users WHERE user_name = '$userName'";
                                $result = mysqli_query($conexion, $sql);

                                if ($result && $result->num_rows > 0) {
                                    $username = $result->fetch_assoc();

                                    $user = $username['user_name']; // Reemplaza 'product_name' con el campo del nombre en tu base de datos

                                    // Mostrar el pop-up con la información del producto
                                    echo '<div class="popup" id="productPopup">';
                                    echo '<span class="close-button" onclick="closePopup()">&times;</span>';
                                    echo '<h2>Usuario encontrado</h2>';
                                    echo '<img class="userIcon" src="../Images/userIcon.svg" alt="Usuario">';
                                    echo '<h3>' . $user . '</h3>';
                                    echo '</div>';
                                } else {
                                    echo '<div class="popup" id="productPopup">';
                                    echo '<span class="close-button" onclick="closePopup()">&times;</span>';
                                    echo '<p>No se encontró el usuario.</p>';
                                    echo '</div>';
                                }
                            }
                        ?>

                        <?php   
                            $sql = "SELECT * FROM users";
                            $result = $conexion->query($sql);

                            if ($result->num_rows > 0) {
                                echo "<table>";
                                echo "<tr><th>ID</th><th>Nombre</th><th>Apellidos</th><th>Correo electrónico</th><th>Contraseña</th><th>Acciones</th></tr>";
                            
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["id_user"] . "</td>";
                                    echo "<td>" . $row["user_name"] . "</td>";
                                    echo "<td>" . $row["last_name"] . "</td>";
                                    echo "<td>" . $row["user_email"] . "</td>";
                                    echo "<td>" . $row["user_password"] . "</td>";
                                    echo "<td>";
                                    echo "<a class='deleteUserClass' href='deleteUser.php?id=" . $row["id_user"] . "'>Eliminar</a> ";
                                    echo "<a class='modifyUserClass' href='modifyUsers.php?id=" . $row["id_user"] . "'>Modificar</a>";
                                    // echo "<button class='modifyUserClass' data-id='" . $row["id_user"] . "' data-toggle='modal' data-target='#modifyModal'>Modificar</button>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";

                            } else {
                                echo "No se encontraron productos.";
                            }
                            
                            $conexion->close();
                        ?>  
                    </div>
                </div>
            </section>
        </div>

        <!-- This modal is to add new users -->
        <dialog id="modal">
            <div class="addUserContainer">
                <form id="addUserForm" method="POST" action="registerAdmin.php">
                    <div><h1 align="center">Agregar usuario</h1>
                    </div>
                    <div class="registerContainer">
                        <label>Nombre</label>
                        <div class="user-content">
                            <input name="name" type="text" placeholder="Nombre">
                        </div>
                        <label>Apellidos</label>
                        <div class="user-content">
                            <input name="last_name" type="text" placeholder="Apellido">
                        </div>
                        <label>Correo</label>
                        <div class="user-content">
                            <input name="email_address" type="text" placeholder="correo@dominio.com">
                        </div>
                        <label>Contraseña</label>
                        <div class="pass-content">
                            <input name="password" type="password" placeholder="********">
                        </div>
                        <label>Repetir contraseña</label>
                        <div class="pass-content">
                            <input name="repeat_password" type="password" placeholder="********">
                        </div>
                    </div>
                    <div class="btnCloseContainer">
                        <div>
                            <button name="register" id ="btnCloseModal">Aceptar</button>
                        </div>
                    </div>
                </form>
        </dialog>

        <!-- Here is the modal for modifications -->
        <!-- <dialog id="modifyModal">
            <div class="modifyContainer">
                <form id="modifyUser" method="POST" action="updateUser.php">
                    <div><h1 align="center">Modificar usuario</h1></div>
                    <div class="modifyContent">
                        <?php
                            if (isset($_GET["id"])) {
                                $id = $_GET["id"];
                            
                                include 'connection.php';

                                //Get the data of user from DB
                                $sql = "SELECT * FROM users WHERE id_user = $id";
                                $result = $conexion->query($sql);

                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $name = $row["user_name"];
                                    $lastName = $row["last_name"];
                                    $email = $row["user_email"];
                                    $password = $row["user_password"];         

                                    echo "<form action='updateUser.php' method='POST'>";
                                    echo "<input type='hidden' name='id' value='$id' />";
                                    echo "Nombre: <input type='text' name='name' value='$name' /><br>";
                                    echo "Apellidos: <input type='text' name='lastName' value='$lastName' /><br>";
                                    echo "Correo electrónico: <input type='email' name='email_address' value='$email' /><br>";
                                    echo "Contraseña: <input type='password' name='password' value='$password' /><br>";
                                    echo "<input type='submit' value='Guardar cambios' />";
                                    echo "</form>";
                                } else {
                                    echo "No se encontró el usuario.";
                                }
                                
                                mysqli_close($conexion);
                            }
                        ?>
                    </div>
                    <div class="btnCloseContainer">
                        <div>
                            <button name="register" id ="sendModifications">Aceptar</button>
                        </div>
                    </div>
                </form>
        </dialog> -->
    <script>
        function closePopup() {
            var popup = document.getElementById("productPopup");
            popup.style.display = "none";
        }

        function showPopup() {
            var popup = document.getElementById("productPopup");
            popup.style.display = "block";
        }

        document.addEventListener("keydown", function(event) {
            if (event.key === "Escape") {
                closePopup();
            }
        });
    </script>
    <script src="../JavaScript/adminFunctions.js"></script>
</body>
</html>