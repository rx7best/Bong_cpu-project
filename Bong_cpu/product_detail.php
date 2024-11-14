<?php 
session_start();
require_once('connect.php');

if(!isset($_GET['id'])){
    header("location: ./");
    exit();
}


$sql = "SELECT * FROM product WHERE product_id = '".mysqli_real_escape_string($conn, $_GET['id'])."'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BongCPU</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
    body {
        background-image: url('images/bgk.png');
        background-size: cover; 
        background-position: center; 
    }
</style>
<body>
<?php require("menu.php"); ?> 

<div class="container mx-auto px-4 mt-4 flex">
    
<div class="w-1/6 bg-purple-200 p-4 rounded-lg drop-shadow-2xl">
            <h2 class="text-lg font-semibold">ประเภทของคอมเซ็ต</h2>   
            <ul class="mt-4">
            <li class="mt-4 hover:bg-purple-400">
                    <a href="?type_id=0">ทั้งหมด/All</a>
                </li>
                <li class="mt-4 hover:bg-purple-400">
                    <a href="?type_id=1">ไม่มีการ์ดจอแยก/non GPU</a>
                </li>
                
                <li class="mt-4 hover:bg-purple-400">
                    <a href="?type_id=2">มีการ์ดจอแยก/Have GPU</a>
                </li>
            </ul>
        </div>

    
    <div class="w-3/4 mx-auto">
    <form method="post" action="cartinfo.php" id="cart" onsubmit="return validateForm()">
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-xl font-semibold mb-4"><?php echo $row['product_name']; ?></h1>
        <div class="flex justify-center mb-6">
            <img src="<?php echo $row['images']; ?>" class="w-1/3 rounded-lg shadow">
        </div>
        <h2 class="text-lg font-semibold mb-2">รายละเอียดสเปค</h2>
        <ul class="text-sm space-y-2">
            <li><strong>CPU : </strong><?php echo $row['cpu']; ?></li>
            <li><strong>Mainboard : </strong><?php echo $row['mainboard']; ?></li>
            <li><strong>Graphic card : </strong><?php echo $row['gpu']; ?></li>
            <li><strong>Memory : </strong><?php echo $row['ram']; ?></li>
            <li><strong>Storage : </strong><?php echo $row['storage']; ?></li>
            <li><strong>Power Supply : </strong><?php echo $row['power_supply']; ?></li>
            <li><strong>Case : </strong><?php echo $row['pc_case']; ?></li>
        </ul>

      
        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
        <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
        <input type="hidden" name="price" value="<?php echo $row['price']; ?>">

      
        <div class="mt-6 flex justify-between">
            <div class="">
                <label for="quantity" class="block text-sm font-medium text-gray-700">จำนวน:</label>
                <input type="number" id="quantity" name="quantity" value="1" min="1" class="mt-1 block w-24 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
        </div>
        

        <div class="flex justify-end mt-6">
            <div class="text-2xl font-bold text-purple-600 mr-3"><?php echo number_format ($row['price'], 0, '.', ',');?>
                <span class="text-gray-600 text-sm ml-2">(รวมภาษี 7%)</span>
            </div>
            <button type="submit" name="add_to_cart" class="text-stone bg-[#fce568] hover:bg-[#FFD700] focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 dark:shadow-lg dark:shadow-stone-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                Add to Cart
            </button>
        </div>
    </div>
</form>

    </div>
</div>
</body>
</html>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart_id = uniqid('cart_id', true); 
  
    $product_id = $_POST['product_id'] ?? '';
    $product_name = $_POST['product_name'] ?? '';
    $price = $_POST['price'] ?? '';

    require("connect.php");

    $sql = "USE bong_cpu";
    $conn->query($sql);

    $sql = "INSERT INTO cart (cart_id, product_id, product_name, price) VALUES ('$cart_id', '$product_id', '$product_name', ' $price')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Item added to cart successfully!');</script>";
        echo "<br>การเพิ่มข้อมูลลงในฐานข้อมูลประสบความสำเร็จ";
    } else {
        echo "<br>ไม่สามารถเพิ่มข้อมูลใหม่ลงในฐานข้อมูลได้: " . $conn->error;
    }

    $conn->close();
    header('Refresh:0; url=frmManagecart.php');
}
?>
