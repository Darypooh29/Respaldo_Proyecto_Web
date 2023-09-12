<!-- <?php
    include 'connection.php';

    if (isset($_GET['id'])) {
        $productID = $_GET['id'];
    }

    if (isset($_SESSION['user_id'])) {
        $userID = $_SESSION['user_id'];
    }

    $getProduct = mysqli_query($conexion, "SELECT * FROM products WHERE id_product = '$productID'");

    if ($getProduct) {
        $productInfo = mysqli_fetch_assoc($getProduct);
        $nameProduct = $productInfo['product_name'];
        $productPrice = $productInfo['product_price'];
        $descriptionProduct = $productInfo['product_description'];
        $productImage = $productInfo['product_image'];
        $quantityProduct = 1;

        $insertInfo = mysqli_query($conexion, "INSERT INTO carrito (id_carrito, id_usuario, id_producto, product_name, product_price, product_quantity, product_image) VALUES (0, '$userID', '$productID', '$nameProduct', '$productPrice', '$quantityProduct', '$productImage')");
    }
?>

<?php
    $getCartItems = mysqli_query($conexion, "SELECT * FROM carrito WHERE id_usuario = '$userID'");

    echo '<div class="container">';
    echo '<h2>Productos en el carrito</h2>';
    while ($cartItem = mysqli_fetch_assoc($getCartItems)) {
        $productName = $cartItem['product_name'];
        $productPrice = $cartItem['product_price'];
        $productImage = $cartItem['product_image'];

        echo '<div class="product">';
            echo '<img src="'.$productImage.'" alt="'.$productName.'">';
            echo '<h3>'.$productName.'</h3>';
            echo '<p>Precio: '.$productPrice.'</p>';
        echo '</div>';
    }
    echo '</div>';
?> -->

<!-- <?php
                        if (isset($_SESSION['username'])) {
                            $username = $_SESSION['username'];
                            echo "<button onclick=\"window.location.href='car.php'\"><i class=\"fa-solid fa-cart-shopping\"></i></button>";
                        } else {
                            echo "<button onclick=\"window.location.href='car.php'\"><i class=\"fa-solid fa-cart-shopping\"></i></button>";
                        }
                    ?> -->