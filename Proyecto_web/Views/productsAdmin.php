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
        <link rel="stylesheet" href="../Styles/productsAdmin.css">
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
                    <li><a href="../Views/login.html" class="action_btn" id="boton">Inicio de sesion</a></li>
                </div>
            </header>
            <!-- Here is the table with the info from DB -->
            <section class="main-register">
                <div class="usersContent">
                    <div class="tableContainer">
                        <div class="tableHeader">
                            <div class="buttonContainer">
                                <button id="openModal">
                                    Agregar
                                </button>
                            </div> 
                            <div class="searchContainer">
                                <form class="searchForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <div>
                                        <input type="text" name="productName" placeholder="Ingrese el nombre del producto">
                                    </div>
                                    <div>
                                        <button type="submit" id = "login-button" ><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <?php
                            // Verificar si se ha enviado el formulario de búsqueda
                            if (isset($_POST['productName'])) {
                                $productName = $_POST['productName'];

                                $sql = "SELECT * FROM products WHERE product_name = '$productName'";
                                $result = mysqli_query($conexion, $sql);

                                if ($result && $result->num_rows > 0) {
                                    $producto = $result->fetch_assoc();

                                    $imagen = $producto['product_image']; // Reemplaza 'product_image' con el campo de la imagen en tu base de datos
                                    $nombre = $producto['product_name']; // Reemplaza 'product_name' con el campo del nombre en tu base de datos

                                    // Mostrar el pop-up con la información del producto
                                    echo '<div class="popup" id="productPopup">';
                                    echo '<span class="close-button" onclick="closePopup()">&times;</span>';
                                    echo '<h2>Producto encontrado</h2>';
                                    echo '<img src="' . $imagen . '" alt="' . $nombre . '">';
                                    echo '<h3>' . $nombre . '</h3>';
                                    echo '</div>';
                                } else {
                                    echo '<div class="popup" id="productPopup">';
                                    echo '<span class="close-button" onclick="closePopup()">&times;</span>';
                                    echo '<p>No se encontró el producto.</p>';
                                    echo '</div>';
                                }
                            }
                        ?>

                        <?php   
                            $sql = "SELECT * FROM products";
                            $result = $conexion->query($sql);

                            if ($result->num_rows > 0) {
                                echo "<table>";
                                echo "<tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Precio</th><th>Stock</th><th>Peso</th><th>Imagen</th><th>Acciones</th></tr>";
                            
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["id_product"] . "</td>";
                                    echo "<td>" . $row["product_name"] . "</td>";
                                    echo "<td>" . $row["product_description"] . "</td>";
                                    echo "<td>" . $row["product_price"] . "</td>";
                                    echo "<td>" . $row["product_stock"] . "</td>";
                                    echo "<td>" . $row["product_weight"] . "</td>";
                                    echo "<td><img src='" . $row["product_image"] . "' alt='Imagen del producto' width='50'></td>";
                                    echo "<td>";
                                    echo "<a class='deleteProductClass' href='deleteProduct.php?id=" . $row["id_product"] . "'>Eliminar</a> ";
                                    echo "<a class='modifyProductClass' href='modifyProducts.php?id=" . $row["id_product"] . "'>Modificar</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            
                                echo "</table>";
                            } else {
                                echo "No hay productos registrados";
                            }
                            
                            $conexion->close();
                        ?>
                    </div>
                </div>
            </section>
        </div>

        <!-- This modal is to add new products -->
        <dialog id="modal">
            <div class="addUserContainer">
                <form id="addProductForm" method="POST" action="registerProduct.php">
                    <div><h1 align="center">Agregar producto</h1>
                    </div>
                    <div class="registerContainer">
                        <label>Nombre del producto</label>
                        <div class="user-content">
                            <input name="product" type="text" placeholder="Nombre">
                        </div>
                        <label>Descripción</label>
                        <div class="user-content">
                            <input name="description" type="text" placeholder="Apellido">
                        </div>
                        <label>Precio</label>
                        <div class="user-content">
                            <input name="price" type="number" step="0.01" name="price" placeholder="Ingrese el precio"/>
                        </div>
                        <label>Cantidad/Stock</label>
                        <div class="pass-content">
                            <input name="stock" type="number" name="stock" placeholder="12"/>
                        </div>
                        <label>Peso</label>
                        <div class="pass-content">
                            <input name="weight" type="number" step="0.01" name="weight" placeholder="Ingrese el peso del producto"/>
                        </div>
                        <label for="">Imagen</label>
                        <div class="user-content">
                            <input name="image" type="text" placeholder="">
                        </div>
                    </div>
                    <div class="btnCloseContainer">
                        <div>
                            <button name="register" id ="btnCloseModal">Aceptar</button>
                        </div>
                    </div>
                </form>
        </dialog>


    <script>
        function closePopup() {
            var popup = document.getElementById("productPopup");
            popup.style.display = "none";
        }

        function showPopup() {
            var popup = document.getElementById("productPopup");
            popup.style.display = "block";
        }

        document.addEventListener("keydown", function(event) {
            if (event.key === "Escape") {
                closePopup();
            }
        });
    </script>
    <script src="../JavaScript/adminFunctions.js"></script>
</body>
</html>