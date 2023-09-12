<?php
    include 'connection.php';

    $product = $_POST ['product'];
    $description = $_POST ['description'];
    $price = $_POST ['price'];
    $stock = $_POST ['stock'];
    $weight = $_POST ['weight'];
    $image = $_POST ['image'];

    $sql = mysqli_query($conexion, "INSERT INTO products(id_product, product_name, product_description, product_price, product_stock, product_weight, product_image) values (0, '$product', '$description', '$price', '$stock', '$weight', '$image')");
    if($sql){
        header("location: productsAdmin.php");
    }else{
        echo "Producto no agregado";
    }
?>