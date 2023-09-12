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
        <link rel="stylesheet" href="../Styles/modify.css">
    </head>
    <body>
        <div class="main-container">
            <header>
                <nav class="navBar">
                    <div class="logo"><a href="#">Suplementos Darykiller</a>
                    </div>
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

                        <div class="toggle_btn"><i class="fa-solid fa-bars"></i></div>

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
            <?php
                if (isset($_GET["id"])) {
                    $id = $_GET["id"];

                    include 'connection.php';

                    // Obtener los datos del producto de la base de datos
                    $sql = "SELECT * FROM products WHERE id_product = $id";
                    $result = $conexion->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $product = $row['product_name'];
                        $description = $row['product_description'];
                        $price = $row['product_price'];
                        $stock = $row['product_stock'];
                        $weight = $row['product_weight'];
                        $image = $row['product_image'];

                        echo "<div class='mainContainer'>";
                        echo "<form class='formContent' action='updateProducts.php' method='POST'>";
                            echo "<h3 align='center'>Editar</h3>";
                            echo "<input type='hidden' name='id' value='$id' />";
                            echo "Nombre del producto: <input type='text' name='product_name' value='$product' /><br>";
                            echo "Descripción: <input type='text' name='product_description' value='$description' /><br>";
                            echo "Precio: <input type='number' step='0.01' name='product_price' value='$price' /><br>";
                            echo "Stock: <input type='number' name='product_stock' value='$stock' /><br>";
                            echo "Peso: <input type='number' step='0.01' name='product_weight' value='$weight' /><br>";
                            echo "Imagen: <input type='text' name='product_image' value='$image' /><br>";
                            echo "<input type='submit' value='Guardar cambios' />";
                            echo "</form>";
                        echo "</div>";
                    } else {
                        echo "No se encontró el producto.";
                    }
                    mysqli_close($conexion);
                }
            ?>
    </body>
</html>