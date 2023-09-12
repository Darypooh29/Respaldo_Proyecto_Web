<?php
    include 'connection.php';
    session_start(); // Iniciar la sesión
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Dary suplements</title>
    <link rel="stylesheet" href="../Styles/products.css">
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
                            echo '<li><a style="color: #000000;" href="../Views/productsUser.php">Productos</a></li>';
                        } else {
                            echo '<li><a style="color: #000000;" href="../Views/products.php">Productos</a></li>';
                        }
                    ?>
                    <!-- <li><a href="../Views/products.php">Productos</a></li> -->
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

                    <button onclick="window.location.href='car.php'"><i class="fa-solid fa-cart-shopping"></i></button>
                </div>
            </nav>
            
            <div class="dropdown_menu">
                <li><a href="../Views/index.html">Inicio</a></li>
                <li><a href="../Views/products.html">Productos</a></li>
                <li><a href="../Views/usage.html">Uso</a></li>
                <li><a href="../Views/references.html">Referencias</a></li>
                <li><a href="../Views/login.html" class="action_btn" id="boton">Inicio de sesion</a></li>
            </div>
        </header>
        <section class="productsContainer">
                <?php
                $sql = 'SELECT * FROM products';
                $resultado = $conexion->query($sql);

                if ($resultado->num_rows > 0) {
                    // Recorrer los productos uno por uno
                    while ($fila = $resultado->fetch_assoc()) {
                        echo '<div class="productContent" onclick="window.location.href=\'product.php?id=' . $fila['id_product'] . '\'">';
                            echo '<div class="productImage">';
                                echo "<td><img src='" . $fila["product_image"] . "' alt='Imagen del producto' width='70rem'></td>";
                            echo '</div>';
                            echo '<div class="productInfo">';
                                echo '<h3>' . $fila['product_name'] . '</h3>';
                                echo '<p>Precio: $' . $fila['product_price'] . '</p>';
                                // echo "<a class='openProduct' href='product.php?id=" . $fila["id_product"] . "'>Añadir al carrito</a>";
                            echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo 'No se encontraron productos.';
                }

                $conexion->close();
                ?>
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