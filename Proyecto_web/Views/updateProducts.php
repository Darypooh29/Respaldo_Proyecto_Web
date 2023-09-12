<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id = $_POST["id"];
        $product = $_POST ['product_name'];
        $description = $_POST ['product_description'];
        $price = $_POST ['product_price'];
        $stock = $_POST ['product_stock'];
        $weight = $_POST ['product_weight'];
        $image = $_POST ['product_image'];

        include 'connection.php';

        $sql = "UPDATE products SET product_name='$product', product_description='$description', product_price='$price', product_stock='$stock', product_weight='$weight', product_image='$image' WHERE id_product=$id";

        if (mysqli_query($conexion, $sql)) {
            header("location: productsAdmin.php");
        } else {
            echo "Error al actualizar el producto: " . mysqli_error($conexion);
        }
        
        mysqli_close($conexion);
    } else {
        echo "Acceso denegado.";
    }
?>