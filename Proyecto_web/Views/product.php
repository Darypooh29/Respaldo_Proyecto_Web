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
    <title>Dary suplements</title>
    <link rel="stylesheet" href="../Styles/product.css">
</head>
<body>
    <div class="main-container">
        <header>
            <nav class="navBar">
                <div class="logo"><a href="#">Suplementos Darykiller</a>
                </div>
                <ul class="options">    
                    <li><a href="../Views/index.php">Inicio</a></li>
                    <?php
                        if (isset($_SESSION['username'])) {
                            $username = $_SESSION['username'];
                            echo '<li><a href="../Views/productsUser.php">Productos</a></li>';
                        } else {
                            echo '<li><a href="../Views/products.php">Productos</a></li>';
                        }
                    ?>
                    <li><a href="../Views/register.php">Registro</a></li>
                    <li><a href="../Views/location.php">Ubicación</a></li>
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
                <li><a href="../Views/index.html">Inicio</a></li>
                <li><a href="../Views/products.html">Productos</a></li>
                <li><a href="../Views/usage.html">Uso</a></li>
                <li><a href="../Views/references.html">Referencias</a></li>
            </div>
        </header>
        <section class="productContainer">
            <div class="productContent">
                <?php
                    $id_producto = $_GET['id'];

                    $sql = "SELECT * FROM products WHERE id_product = $id_producto";
                    $resultado = $conexion->query($sql);

                    if ($resultado->num_rows > 0) {
                
                        $producto = $resultado->fetch_assoc();
                        echo '<div>';
                            echo '<button onclick="window.location.href=\'products.php\'">';
                                echo'<i class="fa-solid fa-chevron-left"></i>';    
                            echo '</button>';
                        echo '</div>';
                        echo '<div>';
                            echo '<h2>' . $producto['product_name'] . '</h2>';
                        echo '</div>';
                        echo "<img src='" . $producto["product_image"] . "' alt='Imagen del producto' width='150rem'>";
                        echo '<p>$ ' . $producto['product_price'] . '</p>';
                        echo '<p>' . $producto['product_description'] . '</p>';
                        echo '<p>El peso del producto es: ' . $producto['product_weight'] . ' lb</p>';
                    } else {
                        echo 'No se encontró el producto.';
                    }

                    $conexion->close();
                ?>
            </div>
        </section>
    </div>
    <footer class="footer-container">
        <div>
            <div class="phone-container">
                <span>
                    <i class="fa-solid fa-phone"></i>
                </span>
                <h4>3326313999</h4>
            </div>
            <div class="email-container">
                <span>
                    <i class="fa-solid fa-envelope"></i>
                </span>
                <h4>dchavikiller290@gmail.com</h4>
            </div>
            <div class="location-container">
                <span>
                    <i class="fa-sharp fa-solid fa-location-dot"></i>
                </span>
                <h4>1000 Paseo de los catañones Tabachines 45188</h4>
            </div>
        </div>
        <div class="links">
            <h2>Enlaces</h2>
            <h4>Inicio</h4>
            <h4>Productos</h4>
            <h4>Registro</h4>
            <h4>Ubicación</h4>
            <h4>Contactanos</h4>
        </div>
        <div class="social-container">
            <h2>Redes sociales</h2>
            <div class="social-content">
                <button><img src="../Images/icons8-instagram.svg" alt=""></button>
                <button><img src="../Images/icons8-facebook-nuevo.svg" alt=""></button>
                <button><img src="../Images/icons8-twitter-circled.svg" alt=""></button>
                <button><img src="../Images/icons8-whatsapp.svg" alt=""></button>
            </div>
        </div>
        <div class="contact">
            <h2>Informanos</h2>
            <h4>Envía alguna recomendación</h4>
            <div class="email-content">
                <input type="text" placeholder="Nombre">
                <input type="text" placeholder="Correo">
                <button>Aceptar</button>
            </div>
        </div>
    </footer>
    <script src="../JavaScript/main_function.js"></script>
</body>
</html>