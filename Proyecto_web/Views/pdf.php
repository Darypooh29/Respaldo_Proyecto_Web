<?php
include 'connection.php';
require ('../fpdf/fpdf.php');
session_start();

if (isset($_POST['user_id'])) {
    $userID = $_POST['user_id'];

    $getCartItems = mysqli_query($conexion, "SELECT id_producto, product_name, product_price, product_image, SUM(product_quantity) as total_quantity FROM carrito WHERE id_usuario = '$userID' GROUP BY id_producto");

    if ($getCartItems->num_rows > 0) {
        $cartData = array(); 

        while ($row = $getCartItems->fetch_assoc()) {
            $cartData[] = $row;
        }

        $productIDs = array();
        $productNames = array();
        $productPrices = array();
        $productImages = array();
        $productQuantities = array();
        $totalPrice = 0;

        if (!empty($cartData)) {
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(0, 10, 'Detalles de la compra', 0, 1, 'C');
            $pdf->Ln(10);
            $pdf->SetFont('Arial', '', 12);
        
            foreach ($cartData as $product) {
                $productID = $product['id_producto'];
                $productName = $product['product_name'];
                $productPrice = $product['product_price'];
                $productImage = $product['product_image'];
                $productQuantity = $product['total_quantity'];
                $totalPrice += $productPrice * $productQuantity;

                $imageWidth = 20; 
                $imageHeight = 15; 
                $pdf->Cell($imageWidth, $imageHeight, '', 0, 0, 'C');
                $pdf->Image($productImage, $pdf->GetX(), $pdf->GetY(), $imageWidth);
                $pdf->SetX($pdf->GetX() + $imageWidth);
                $pdf->MultiCell(0, 10, 'Producto: ' . $productName . "\n" . 'ID del producto: ' . $productID . "\n" . 'Precio: $' . $productPrice . "\n" . 'Cantidad: ' . $productQuantity, 0, 'L');
                $pdf->Ln(10);
            }
        
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(0, 10, 'Precio Total: $ ' . $totalPrice, 0, 1, 'R');
            $pdf->Output('carrito.pdf', 'F');

            $getUserEmail = mysqli_query($conexion, "SELECT user_email FROM users WHERE id_user = '$userID'");
            $userEmail = '';
            if ($getUserEmail->num_rows > 0) {
                $userData = $getUserEmail->fetch_assoc();
                $userEmail = $userData['user_email'];
            }

            $to = $userEmail;
            $subject = 'Detalles del pedido';
            $message = '¡Buen día! Te enviamos los detalles de tu pedido, gracias por tu preferencia.';

            $headers = array(
                'From: a21310390@ceti.mx',
                'Reply-To: dchavira290@gmail.com',
                'MIME-Version: 1.0',
                'Content-Type: multipart/mixed; boundary="boundary"'
            );

            $attachment = chunk_split(base64_encode(file_get_contents('carrito.pdf')));

            $body = "--boundary\r\n" .
                "Content-Type: text/plain; charset=ISO-8859-1\r\n" .
                "Content-Transfer-Encoding: 7bit\r\n" .
                "\r\n" .
                $message . "\r\n" .
                "\r\n" .
                "--boundary\r\n" .
                "Content-Type: application/pdf; name=\"carrito.pdf\"\r\n" .
                "Content-Transfer-Encoding: base64\r\n" .
                "Content-Disposition: attachment\r\n" .
                "\r\n" .
                $attachment . "\r\n" .
                "\r\n" .
                "--boundary--";

            if (mail($to, $subject, $body, implode("\r\n", $headers))) {
                header("location: accept.php");
            } else {
                echo "Hubo un error al enviar el correo.";
            }

        } else {
            echo "No hay productos en el carrito.";
        }        
    }
}
?>