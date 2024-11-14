<?php
// รวมไฟล์ connect.php
include('connect.php');

// ดึงข้อมูลรวมยอดขาย
$sql = "SELECT SUM(total_order) AS total_order FROM `order`";
$result = $conn->query($sql);

$totalOrder = 0; // ค่าเริ่มต้น

if ($result->num_rows > 0) {
    // ข้อมูลมีอยู่
    $row = $result->fetch_assoc();
    $totalOrder = $row["total_order"];
} else {
    // ไม่มีข้อมูล
    $totalOrder = 0;
}

// ดึงข้อมูลจำนวนออเดอร์
$sql = "SELECT COUNT(*) AS total_orders FROM `order`";
$result = $conn->query($sql);

$Order = 0; // ค่าเริ่มต้น

if ($result->num_rows > 0) {
    // ข้อมูลมีอยู่
    $row = $result->fetch_assoc();
    $Order = $row["total_orders"];
} else {
    // ไม่มีข้อมูล
    $Order = 0;
}

// ดึงข้อมูล total_order สำหรับแต่ละ order_id
$sql = "SELECT order_id, total_order FROM `order`";
$result = $conn->query($sql);

$labels = [];
$data = [];


if ($result->num_rows > 0) {
    $orders = [];
    
    // ดึงข้อมูลทั้งหมดเก็บใน array ก่อน
    while ($row = $result->fetch_assoc()) {
        $orders[] = [
            'order_id' => $row['order_id'],
            'total_order' => $row['total_order']
        ];
    }

    // ใช้ array_multisort จัดเรียง order_id ตามลำดับจากน้อยไปมาก
    array_multisort(array_column($orders, 'order_id'), SORT_ASC, $orders);
    
    // แยกข้อมูลออกเป็น labels และ data
    foreach ($orders as $order) {
        $labels[] = $order['order_id']; // หรือจะใช้ $row['order_date'] หากต้องการแสดงวันที่
        $data[] = $order['total_order'];
    }
} else {
    // ไม่มีข้อมูล
    $labels = [];
    $data = [];
}


// ปิดการเชื่อมต่อ
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BongCPU</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<style>
    body {
        background-image: url('images/bgk.png');
        background-size: cover; 
        background-position: center; 
    }
</style>
<body>
<?php include("menu_admin.php"); ?> 

<div class="container mx-auto px-4 mt-4">
    <h1 class="text-4xl font-bold mb-4 ">DashBoard</h1>
    <!-- Grid layout with 2x1 for cards and graph below -->
    <div class="grid grid-cols-2 gap-4">
        <!-- Sales Card -->
        <div class="bg-purple-500 text-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold">ยอดขาย</h2>
            <p class="text-3xl mt-4">$<?php echo number_format($totalOrder); ?> บาท</p>
        </div>
        <!-- Orders Card -->
        <div class="bg-yellow-400 text-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold">จำนวนออเดอร์</h2>
            <p class="text-3xl mt-4"><?php echo number_format($Order); ?> ออเดอร์</p>
        </div>
    </div>
    
    <!-- Graph Section - Takes full width -->
    <div class="mt-6">
        <div class="bg-gray-300 p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold mb-4 text-center">ยอดของแต่ละออเดอร์</h3>
            <canvas id="orderChart"></canvas>
        </div>
    </div>
</div>

<!-- Chart.js for rendering the graph -->
<script>
const ctx = document.getElementById('orderChart').getContext('2d');
const orderChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($labels); ?>,
        datasets: [{
            label: 'ยอดรวมของออเดอร์นี้',
            data: <?php echo json_encode($data); ?>,
            borderColor: 'rgba(255, 51, 153, 1)',
            fill: false,
            tension: 0.1
        }]
    },
    options: {
        scales: {
            
      x: {
        display: true,
        title: {
          display: true,
          text: 'ออเดอร์(จำนวน)'
        }
      },
      y: {
        display: true,
        title: {
          display: true,
          text: 'ราคา(บาท)'
        },
        suggestedMin: -10,
        suggestedMax: 200
        }
    }
    }
});
</script>

<!-- Back Button -->
<div class="flex justify-center mt-2">
    <div class="mt-5">
        <a href="home.php">
            <button class="bg-yellow-400 text-white font-bold py-2 px-8 rounded-lg shadow-md hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300">กลับไปยังหน้าหลัก</button>
        </a>
    </div>
</div>
</body>
</html>
