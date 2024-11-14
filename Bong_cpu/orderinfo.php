<?php
session_start();
require_once('connect.php');

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
if (!isset($_SESSION['user_id'])) {
    header('Location: login_db.php');
    exit();
}

// รับค่าจากฟอร์ม
$order_total = isset($_POST['order_total']) ? $_POST['order_total'] : 0;
$user_id = $_SESSION['user_id'];

// ตรวจสอบว่ามีรายการสินค้าในตะกร้าหรือไม่
$sql = "SELECT COUNT(*) as item_count FROM cart WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if ($row['item_count'] == 0) {
    // ไม่มีสินค้าในตะกร้า
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                title: "ไม่มีสินค้า!",
                text: "ไม่มีสินค้าในตะกร้าของคุณ.",
                icon: "warning",
                timer: 3000,
                showConfirmButton: false
            }).then(function() {
                window.location.href = "frmManagecart.php";
            });
        });
    </script>';
} elseif ($order_total > 0) {
    // มีสินค้าในตะกร้าและจำนวนรวมการสั่งซื้อมากกว่า 0
    $order_date = date('Y-m-d H:i:s');
    $insert_sql = "INSERT INTO `order` (user_id, order_date, total_order) VALUES ('$user_id', '$order_date', '$order_total')";

    if (mysqli_query($conn, $insert_sql)) {
        // ลบสินค้าออกจากตะกร้าหลังจากสั่งซื้อแล้ว
        $delete_cart = "DELETE FROM cart WHERE user_id = '$user_id'";
        mysqli_query($conn, $delete_cart);

        // แสดงข้อความสำเร็จและเปลี่ยนเส้นทาง
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "สำเร็จ!",
                    text: "การสั่งซื้อสำเร็จแล้ว.",
                    icon: "success",
                    timer: 3000,
                    showConfirmButton: false
                }).then(function() {
                    window.location.href = "home.php";
                });
            });
        </script>';
    } else {
        // แสดงข้อความข้อผิดพลาดและเปลี่ยนเส้นทาง
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "ข้อผิดพลาด!",
                    text: "ไม่สามารถทำการสั่งซื้อได้.",
                    icon: "error",
                    timer: 3000,
                    showConfirmButton: false
                }).then(function() {
                    window.location.href = "../";
                });
            });
        </script>';
    }
} else {
    // แสดงข้อความข้อผิดพลาดหากไม่สามารถบันทึกการสั่งซื้อได้
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                title: "ข้อผิดพลาด!",
                text: "ไม่สามารถทำการสั่งซื้อได้.",
                icon: "error",
                timer: 3000,
                showConfirmButton: false
            }).then(function() {
                window.location.href = "../";
            });
        });
    </script>';
}

mysqli_close($conn);
?>
