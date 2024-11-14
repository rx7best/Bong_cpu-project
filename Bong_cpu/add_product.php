<?php
// การเชื่อมต่อกับฐานข้อมูล
session_start();
    include('connect.php');

    $errors = array();

// เมื่อฟอร์มถูกส่ง
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $images = $_POST['images'];
    $cpu = $_POST['cpu'];
    $gpu = $_POST['gpu'];
    $ram = $_POST['ram'];
    $storage = $_POST['storage'];
    $mainboard = $_POST['mainboard'];
    $power_supply = $_POST['power_supply'];
    $pc_case = $_POST['pc_case'];
    $price = $_POST['price'];
    $type_id = $_POST['type_id'];

    $sql = "INSERT INTO product (product_name, images, cpu, gpu, ram, storage, mainboard, power_supply, pc_case, price, type_id) 
            VALUES ('$product_name', '$images', '$cpu', '$gpu', '$ram', '$storage', '$mainboard', '$power_supply', '$pc_case', '$price', '$type_id')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('เพิ่มข้อมูลสำเร็จ');
                window.location.href = 'frmadd.php'; // Redirect กลับไปยังหน้า frmadd.php
              </script>";
    } else {
        echo "<script>
                alert('เกิดข้อผิดพลาด: " . $conn->error . "');
                window.location.href = 'frmadd.php'; // Redirect กลับไปยังหน้า frmadd.php
              </script>";
    }
}

$conn->close();
?>
