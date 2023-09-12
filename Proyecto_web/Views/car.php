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
    <link rel="stylesheet" href="../Styles/car.css">
</head>
<body>
    <div class="main-container">
        <header>
            <nav class="navBar">
                <div class="logo"><a href="#">Suplementos Darykiller</a></div>

                <ul class="options">    
                    <li><a href="../Views/index.php">Inicio</a></li>
                    <?php
                        // Verificar si la sesión está iniciada
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

                    <button onclick="window.location.href='car.php'"><i class="fa-solid fa-cart-shopping"></i></button>
                </div>
            </nav>
            <div class="dropdown_menu">
                <li><a href="../Views/index.html">Inicio</a></li>
                <li><a href="../Views/products.php">Productos</a></li>
                <li><a href="../Views/usage.html">Uso</a></li>
                <li><a href="../Views/references.html">Referencias</a></li>
                <li><a href="../Views/login.html" class="action_btn" id="boton">Inicio de sesion</a></li>
            </div>
        </header>
        <main class="mainContent">
            <?php
                include 'connection.php';

                if (isset($_GET['id'])) {
                    $productID = $_GET['id'];

                    if (isset($_SESSION['user_id'])) {
                        $userID = $_SESSION['user_id'];

                        $getProduct = mysqli_query($conexion, "SELECT * FROM products WHERE id_product = '$productID'");

                        if ($getProduct) {
                            $productInfo = mysqli_fetch_assoc($getProduct);
                            $nameProduct = $productInfo['product_name'];
                            $productPrice = $productInfo['product_price'];
                            $descriptionProduct = $productInfo['product_description'];
                            $productImage = $productInfo['product_image'];

                            $checkProduct = mysqli_query($conexion, "SELECT * FROM carrito WHERE id_usuario = '$userID' AND id_producto = '$productID'");

                            if (mysqli_num_rows($checkProduct) > 0) {
                                $updateQuantity = mysqli_query($conexion, "UPDATE carrito SET product_quantity = product_quantity + 1 WHERE id_usuario = '$userID' AND id_producto = '$productID'");

                                if ($updateQuantity) {
                                    echo "Se ha actualizado la cantidad del producto en el carrito.";
                                } else {
                                    echo "Error al actualizar la cantidad del producto en el carrito.";
                                }
                            } else {
                                $insertInfo = mysqli_query($conexion, "INSERT INTO carrito (id_carrito, id_usuario, id_producto, product_name, product_price, product_quantity, product_image) VALUES (0, '$userID', '$productID', '$nameProduct', '$productPrice', 1, '$productImage')");

                                if ($insertInfo) {
                                    echo "El producto se ha agregado al carrito correctamente.";
                                } else {
                                    echo "Error al agregar el producto al carrito.";
                                }
                            }
                        }
                    } else {
                        echo '<h2>Debes iniciar sesión para agregar productos al carrito.</h2>';
                    }
                }

                if (isset($_SESSION['user_id'])) {
                    $userID = $_SESSION['user_id'];

                    $getCartItems = mysqli_query($conexion, "SELECT id_producto, product_name, product_price, product_image, SUM(product_quantity) as total_quantity FROM carrito WHERE id_usuario = '$userID' GROUP BY id_producto");
                    echo '<div class="container">';
                    echo '<h2>Productos en el carrito</h2>';

                    if (mysqli_num_rows($getCartItems) > 0) {
                        echo '<div class="productsContent">';
                            echo'<span></span>';
                            echo'<span>Producto</span>';
                            echo'<span>Precio</span>';
                            echo'<span>Cantidad</span>';
                            echo'<span></span>';
                        echo '</div>';

                        while ($cartItem = mysqli_fetch_assoc($getCartItems)) {
                            $productName = $cartItem['product_name'];
                            $productPrice = $cartItem['product_price'];
                            $productImage = $cartItem['product_image'];
                            $productQuantity = $cartItem['total_quantity'];
                            $productID = $cartItem['id_producto']; 

                            echo '<div class="product">';
                            echo '<img src="'.$productImage.'" alt="'.$productName.'">';
                            echo '<p>'.$productName.'</p>';
                            echo '<p>$ '.$productPrice.'</p>';
                            echo '<p>'.$productQuantity.'</p>';
                            echo '<a class="btnDelete" href="deleteProductCar.php?id='.$productID.'">Eliminar</a>';
                            echo '</div>';
                        }

                        $getTotal = mysqli_query($conexion, "SELECT SUM(product_price * product_quantity) as total FROM carrito WHERE id_usuario = '$userID'");
                        $totalRow = mysqli_fetch_assoc($getTotal);
                        $totalPrice = $totalRow['total'];
                        $formattedTotal = number_format($totalPrice, 2);
                        
                        echo '<div class="finalContent">';
                            // echo '<a class="email" href="../../sendmail.php">Aceptar</a>';
                            echo '<form action="pdf.php" method="POST">'; // Cambio: Añadir formulario y especificar el archivo a enviar
                            echo '<input type="hidden" name="user_id" value="' . $userID . '">'; // Cambio: Campo oculto para el ID del usuario
                            echo '<button type="submit" class="email" name="submit">Aceptar</button>'; // Cambio: Cambiar la etiqueta <a> por un botón de envío de formulario
                            echo '</form>';
                            
                            echo '<div class="total-price">';
                                echo 'Total: $ '.$formattedTotal;
                            echo '</div>';
                        echo '</div>';

                    } else {
                        echo 'No hay productos en el carrito.';
                    }

                    echo '</div>';
                } else {
                    echo "Debes iniciar sesión para ver los productos en el carrito.";
                }
            ?>
        </main>

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
    </div>
    <script src="../JavaScript/main_function.js"></script>
</body>
</html>