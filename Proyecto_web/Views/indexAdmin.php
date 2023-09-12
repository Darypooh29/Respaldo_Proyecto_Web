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
    <link rel="stylesheet" href="../Styles/indexAdmin.css">
</head>
<body>
    <div class="mainContainer">
        <header>
            <nav class="navBar">
                <div class="logo"><a href="#">Suplementos Darykiller</a>
                </div>

                <ul class="options">    
                    <li><a class="link-home" href="../Views/indexAdmin.php">Administración</a></li>
                </ul>

                <div>
                    <?php
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

                    <button>
                        <i class="fa-solid fa-cart-shopping"></i>
                    </button>
                </div>
            </nav>

            <div class="dropdown_menu">
                <li><a href="../Views/login.html" class="action_btn" id="boton">Inicio de sesion</a></li>
            </div>
        </header>
        <main class="contentContainer">
            <div class="mainContent">
                <button id="userManagement">
                    <div class="userContent">
                        <h2>Usuarios</h2>
                    </div>

                    <div class="userIcon">
                        <span class="username-icon">
                            <i class="fa-solid fa-users"></i>
                        </span>
                    </div>
                </button>

                <button id="productsManagement">
                    <div>
                        <h2>Productos</h2>
                    </div>
                    
                    <div class="productsIcon">
                        <span>
                            <i class="fa-sharp fa-solid fa-box-archive"></i>
                        </span>
                    </div>
                </button>
            </div>
        </main>
    </div>
    <script src="../JavaScript/indexAdmin.js"></script>
</body>
</html>