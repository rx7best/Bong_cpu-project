<?php
session_start();
require_once('connect.php');

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// ดึงข้อมูลสินค้าจากตาราง cart ในฐานข้อมูล
$user_id = $_SESSION['user_id'];
$sql = "SELECT cart_id, product_name, price, quantity, total_price FROM cart WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);

// สร้างอาร์เรย์สำหรับเก็บข้อมูลสินค้าที่ได้จากฐานข้อมูล
$cart_items = [];
$order_total = 0; // Initialize order_total

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $cart_items[] = [
            'cart_id' => $row['cart_id'],  // Add this line to include cart_id
            'product_name' => $row['product_name'],
            'price' => $row['price'],
            'quantity' => $row['quantity'],
            'total_price' => $row['total_price']
        ];
        $order_total += $row['total_price']; // Sum up total_price
    }
} else {
    echo "";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<?php require("menu.php"); ?> 

<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6">ตะกร้าสินค้า</h1>
        
        <!-- Cart Container -->
        <div class="bg-gray-200 p-6 rounded-lg shadow-md">
            <?php if (!empty($cart_items)): ?>
                <?php foreach ($cart_items as $item): ?>
                    <div class="bg-white p-4 rounded-lg shadow mb-4">
                        <div class="flex justify-between flex-row">
                            <div class="basis-1/2">
                                <h2 class="text-lg font-bold">ชื่อสินค้า</h2>
                                <p class="text-gray-600"><?php echo $item['product_name']; ?></p>
                            </div>
                            <div class="basis-1/6">
                                <h2 class="text-lg font-bold text-center">จำนวน</h2>
                                <p class="text-gray-600 text-center"><?php echo $item['quantity']; ?></p>
                            </div>
                            <div class="basis-1/6">
                                <h2 class="text-lg font-bold text-center">ราคารวม</h2>
                                <p class="text-gray-600 ml-3 text-center"><?php echo number_format($item['total_price'], 0, '.', ','); ?> บาท</p>
                            </div>
                            <div class="basis-1/6 flex justify-center">
                                <button class="text-stone bg-[#FF8772] hover:bg-[#FC3F1E] focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 dark:shadow-lg dark:shadow-stone-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 h-12">
                                    <a href="del_cart.php?id=<?php echo $item['cart_id']; ?>" class="btn btn-danger">ลบ</a>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                
                <!-- Display total price of all items -->
                <div class="">
                    <h2 class="text-lg font-bold">ราคารวมสินค้าทั้งหมด</h2>
                    <p class="text-gray-600"><?php echo number_format($order_total, 0, '.', ','); ?> บาท</p>
                </div>

            <?php else: ?>
                <p>ไม่มีสินค้าในตะกร้า</p>
            <?php endif; ?>

            <!-- Checkout Button -->
            <form method="POST" action="orderinfo.php">
                <div class="flex justify-center">
                    <button type="submit" class="bg-yellow-400 text-white font-bold py-2 px-8 rounded-lg shadow-md hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300">
                        สั่งซื้อสินค้า
                    </button>
                </div>
   
                <input type="hidden" name="order_total" value="<?php echo $order_total; ?>">
            </form>
        </div>
    </div>
</body>

</html>
