<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('location: frm_login.php');
}

require_once('connect.php');

// Check if a type_id is set in the URL
$type_id = isset($_GET['type_id']) ? (int)$_GET['type_id'] : 0;

// Modify the SQL query based on type_id
if ($type_id > 0) {
    $sql = "SELECT * FROM product WHERE type_id = $type_id";
} else {
    $sql = "SELECT * FROM product";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="images/logo.png">
    <title>หน้าหลัก คอมพิวเตอร์เซต</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php require("menu.php"); ?>

    <style>
        body {
            background-image: url('images/bgk.png');
            background-size: cover; 
            background-position: center; 
        }
    </style>

    <div class="flex justify-center ">
        <div class="relative h-2/6 w-3/5 overflow-hidden mt-5 ">
            <div class="flex transition-transform duration-500" style="transform: translateX(0%);" id="carousel">
                <!-- Slide 1 -->
                <div class="w-full flex-none flex justify-center ">
                    <img src="images/2.png" alt="Image 1" class="w-4/5 h-64 rounded-lg">
                </div>  
                <!-- Slide 2 -->
                <div class="w-full flex-none flex justify-center">
                    <img src="images/2.jpeg" alt="Image 2" class="w-4/5 h-64 rounded-lg">
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 mt-4 flex ">
        <!-- Left Sidebar -->
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

        <!-- Main Content -->
        <div class="w-3/4 grid grid-cols-3 gap-4 p-4 mx-auto">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="bg-white p-6 shadow rounded">
                <div class="flex justify-center"> 
                    <img src="<?php echo $row['images']; ?>" class="w-50 h-50"/>
                </div>
                <p class="text-gray-600 mt-6">
                    <?php echo $row['product_name']; ?>
                </p>
                <div class="mt-4">
                    <p>ราคา : <?php echo number_format ($row['price'], 0, '.', ',');?> บาท </p>
                </div>
                <div class="flex justify-center">
                    <button class="mt-2 bg-yellow-500 text-white px-4 py-2 rounded-lg font-semibold">
                        <a href="product_detail.php?id=<?php echo $row['product_id'] ?>" class="btn btn-warning">รายละเอียด</a>
                    </button>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>

    <div class="bg-yellow-400 mt-20">
        <div class="grid grid-cols-7 mx-auto">
            <div>
                <!-- คอลัมน์ 1 -->
            </div> 
            <div>
                <p class="mt-10 mb-5">ถ้าคุณชอบคอมพิวเตอร์ "เราคือเพื่อนกัน"</p>
                <p>BONGCPU ร้านจำหน่ายคอมพิวเตอร์เกมมิ่งเกียร์ รับประกันทุกชิ้น บริการจัดสเปกคอมพิวเตอร์ ตามการใช้งานในงบประมาณที่ลูกค้าเลือกได้เอง</p>
            </div>
            <div>
                <!-- ช่องทางการติดต่อ -->
            </div>
            <div>
                <p class="mt-10 font-semibold">ช่องทางการติดต่อ</p>
                <p class="mt-5 mb-10">Bong_cpu@gmail.com</p>
            </div>
            <div>
                <p class="mt-10"><i class="mr-3"></i></p>
                <p class="mt-5 mb-10"><i class="fa-brands fa-facebook fa-lg mr-3"></i>Bongcpu</p>
            </div>
            <div>
                <p class="mt-10"><i class="mr-3"></i></p>
                <p class="mt-5 mb-10"><i class="fa-solid fa-phone fa-lg mr-3"></i>091-792-6941</p>
            </div>
            <div></div>
        </div>
    </div>

    <script>
        let currentIndex = 0;

        function showSlide(index) {
            const carousel = document.getElementById('carousel');
            const totalSlides = carousel.children.length;
            const newIndex = (index + totalSlides) % totalSlides;
            carousel.style.transform = `translateX(-${newIndex * 100}%)`;
            currentIndex = newIndex;
        }

        function nextSlide() {
            showSlide(currentIndex + 1);
        }

        // Auto play slider every 5 seconds
        setInterval(() => {
            nextSlide();
        }, 5000); // Change the interval time as needed
    </script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</body>
</html>
