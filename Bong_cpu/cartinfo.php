<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    
</body>
</html>
<?php
session_start(); // Start session to access user_id
require_once('connect.php'); // Include your database connection script

// ตรวจสอบว่ามีการส่งข้อมูลจากฟอร์มหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart_id = uniqid('cart_id_', true); // สร้าง cart_id ที่ไม่ซ้ำกัน
    $user_id = $_SESSION['user_id'] ?? ''; // ดึง user_id จาก session
    $product_id = $_POST['product_id'] ?? '';
    $product_name = $_POST['product_name'] ?? '';
    $price = $_POST['price'] ?? '';
    $quantity = $_POST['quantity'] ?? 1;

    // ตรวจสอบว่ามีการล็อกอินหรือไม่
    if ($user_id) {
        // Calculate total price
        $total_price = $price * $quantity;

        // Select the database
        $sql = "USE bong_cpu";
        $conn->query($sql);

        // ตรวจสอบว่ามีสินค้าในตะกร้าหรือไม่
        $sql_check = "SELECT * FROM cart WHERE product_id = '$product_id' AND user_id = '$user_id'";
        $result_check = $conn->query($sql_check);

        if ($result_check->num_rows > 0) {
            // If product exists, update the quantity and total price
            $row = $result_check->fetch_assoc();
            $new_quantity = $row['quantity'] + $quantity;
            $new_total_price = $price * $new_quantity;
            $sql_update = "UPDATE cart SET quantity = '$new_quantity', total_price = '$new_total_price' WHERE cart_id = '".$row['cart_id']."'";
            
            if ($conn->query($sql_update) === TRUE) {
                $message = "Item quantity and total price updated successfully!";
            } else {
                $message = "Error: " . $sql_update . "<br>" . $conn->error;
            }
        } else {
            // If product does not exist, insert new item with total price
            $sql_insert = "INSERT INTO cart (cart_id, user_id, product_id, product_name, price, quantity, total_price) 
                           VALUES ('$cart_id', '$user_id', '$product_id', '$product_name', '$price', '$quantity', '$total_price')";

            if ($conn->query($sql_insert) === TRUE) {
                $message = "Item added to cart successfully!";
            } else {
                $message = "Error: " . $sql_insert . "<br>" . $conn->error;
            }
        }

        $conn->close();
        echo "<script>
            setTimeout(function() {
                Swal.fire({
                    title: 'ใส่ตะกร้าสำเร็จ',
                    text: '$message Redirecting in 3 seconds.',
                    icon: 'success',
                    timer: 3000,
                    showConfirmButton: false
                }).then(function() {
                    window.location.href = 'frmManagecart.php';
                });
            }, 100);
        </script>";
        exit();
    } else {
        echo "<script>
            Swal.fire({
                title: 'ใส่ตะกร้าไม่สำเร็จ',
                text: 'Please log in to add items to your cart.',
                icon: 'error',
                timer: 3000,
                showConfirmButton: false
            }).then(function() {
                window.location.href = 'home.php'; // Redirect to login page
            });
        </script>";
        exit();
    }
} else {
    echo "<script>
        Swal.fire({
            title: 'Invalid request!',
            text: 'The request method is not supported.',
            icon: 'error',
            timer: 3000,
            showConfirmButton: false
        }).then(function() {
            window.location.href = 'index.php'; // Redirect to home page or any other page
        });
    </script>";
}
?>
