<?php 
session_start();

require_once('connect.php');

if (!isset($_GET['id'])) {
    header("location: ./");
    exit();
}

$productid = mysqli_real_escape_string($conn, $_GET['id']);

// Fetch product data from the database
$sql = "SELECT * FROM product WHERE product_id = '$productid'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$product = mysqli_fetch_assoc($result);

// Check if product data was found
if (!$product) {
    die("Product not found.");
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขสินค้า</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url('images/bgk.png');
            background-size: cover; 
            background-position: center; 
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-2xl">
        <h1 class="text-2xl font-bold mb-6 text-center">แก้ไขสินค้า</h1>
        <form method="post" action="update_product.php">
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>">

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label for="product_name" class="block text-gray-700">ชื่อสินค้า</label>
                    <input type="text" id="product_name" name="product_name" class="mt-1 p-2 w-full border rounded-md bg-gray-100" value="<?php echo htmlspecialchars($product['product_name']); ?>" required>
                </div>
                <div>
                    <label for="images" class="block text-gray-700">รูปภาพ (URL)</label>
                    <input type="text" id="images" name="images" class="mt-1 p-2 w-full border rounded-md bg-gray-100" value="<?php echo htmlspecialchars($product['images']); ?>" required>
                </div>
                <div>
                    <label for="cpu" class="block text-gray-700">CPU</label>
                    <input type="text" id="cpu" name="cpu" class="mt-1 p-2 w-full border rounded-md bg-gray-100" value="<?php echo htmlspecialchars($product['cpu']); ?>" required>
                </div>
                <div>
                    <label for="gpu" class="block text-gray-700">GPU</label>
                    <input type="text" id="gpu" name="gpu" class="mt-1 p-2 w-full border rounded-md bg-gray-100" value="<?php echo htmlspecialchars($product['gpu']); ?>" required>
                </div>
                <div>
                    <label for="ram" class="block text-gray-700">RAM</label>
                    <input type="text" id="ram" name="ram" class="mt-1 p-2 w-full border rounded-md bg-gray-100" value="<?php echo htmlspecialchars($product['ram']); ?>" required>
                </div>
                <div>
                    <label for="storage" class="block text-gray-700">Storage</label>
                    <input type="text" id="storage" name="storage" class="mt-1 p-2 w-full border rounded-md bg-gray-100" value="<?php echo htmlspecialchars($product['storage']); ?>" required>
                </div>
                <div>
                    <label for="mainboard" class="block text-gray-700">Mainboard</label>
                    <input type="text" id="mainboard" name="mainboard" class="mt-1 p-2 w-full border rounded-md bg-gray-100" value="<?php echo htmlspecialchars($product['mainboard']); ?>" required>
                </div>
                <div>
                    <label for="power_supply" class="block text-gray-700">Power Supply</label>
                    <input type="text" id="power_supply" name="power_supply" class="mt-1 p-2 w-full border rounded-md bg-gray-100" value="<?php echo htmlspecialchars($product['power_supply']); ?>" required>
                </div>
                <div>
                    <label for="pc_case" class="block text-gray-700">เคส</label>
                    <input type="text" id="pc_case" name="pc_case" class="mt-1 p-2 w-full border rounded-md bg-gray-100" value="<?php echo htmlspecialchars($product['pc_case']); ?>" required>
                </div>
                <div>
                    <label for="price" class="block text-gray-700">ราคา</label>
                    <input type="number" id="price" name="price" class="mt-1 p-2 w-full border rounded-md bg-gray-100" value="<?php echo htmlspecialchars($product['price']); ?>" required>
                </div>
            </div>
            <div class="mt-6">
                <label for="type_id" class="block text-gray-700">ประเภทสินค้า</label>
                <select id="type_id" name="type_id" class="mt-1 p-2 w-full border rounded-md bg-gray-100" required>
                    <option value="1" <?php if ($product['type_id'] == 1) echo 'selected'; ?>>ไม่มีการ์ดจอแยก/non GPU</option>
                    <option value="2" <?php if ($product['type_id'] == 2) echo 'selected'; ?>>มีการ์ดจอแยก/Have GPU</option>
                </select>
            </div>
            <div class="mt-6 flex justify-center">
                <input type="submit" name="send" value="บันทึกข้อมูลสินค้า" class="px-6 py-2 bg-yellow-400 text-white font-semibold rounded-md shadow-md hover:bg-yellow-500">
                <a href="home_admin.php" class="ml-3 px-6 py-2 bg-red-300 text-white font-semibold rounded-md shadow-md hover:bg-red-500">ย้อนกลับ</a>
            </div>
        </form>
    </div>
</body>
</html>
