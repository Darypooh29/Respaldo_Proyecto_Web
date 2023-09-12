<?php
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        
        include 'connection.php';

        $sql = "DELETE FROM products WHERE id_product = $id";
        
        if (mysqli_query($conexion, $sql)) {
            header("location: productsAdmin.php");
        } else {
            echo "Error al eliminar el usuario: " . mysqli_error($conexion);
        }
        
        mysqli_close($conexion);
    }
?>