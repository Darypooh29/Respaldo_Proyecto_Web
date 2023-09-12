<?php
    session_start(); 
    if (isset($_GET['id'])) {
        $productID = $_GET['id']; 
        echo "ID del producto: " . $productID;
        
        include 'connection.php';

        var_dump($productID);
        $checkProduct = mysqli_query($conexion, "SELECT product_quantity FROM carrito WHERE id_producto = '$productID'");
        $cartItem = mysqli_fetch_assoc($checkProduct);
        $productQuantity = $cartItem['product_quantity'];

        if ($productQuantity > 1) {
            $updateQuantity = mysqli_query($conexion, "UPDATE carrito SET product_quantity = product_quantity - 1 WHERE id_producto = '$productID'");

            if ($updateQuantity) {
                header("Location: car.php");
                exit();
            } else {
                echo "Error al actualizar la cantidad del producto en el carrito.";
            }
        } elseif ($productQuantity == 1) {
            $deleteProduct = mysqli_query($conexion, "DELETE FROM carrito WHERE id_producto = '$productID'");

            if ($deleteProduct) {
                header("Location: car.php");
                exit();
            } else {
                echo "Error al eliminar el producto del carrito.";
            }
        } else {
            echo "El producto no existe en el carrito.";
        }
    } else {
        header("Location: car.php");
        exit();
    }
?>

