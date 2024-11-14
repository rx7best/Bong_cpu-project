<?php 
require_once('connect.php');
if (isset($_POST['send'])) {
    $productid = mysqli_real_escape_string($conn, $_POST['product_id']); 
    $sql = "UPDATE product SET 
        product_name = '".$_POST['product_name']."',
        images = '".$_POST['images']."',
        cpu = '".$_POST['cpu']."',
        gpu = '".$_POST['gpu']."',
        ram = '".$_POST['ram']."',
        storage = '".$_POST['storage']."',
        mainboard = '".$_POST['mainboard']."',
        power_supply = '".$_POST['power_supply']."',
        pc_case = '".$_POST['pc_case']."',
        price = '".$_POST['price']."',
        type_id = '".$_POST['type_id']."' 
        WHERE product_id = '$productid'";

    if (mysqli_query($conn, $sql)) {
        echo '<script> alert("แก้ไขข้อมูลเสร็จเรียบร้อย")</script>';
        header('Refresh:0; url= Manage_product.php');
    } else {
        echo '<script> alert("แก้ไขข้อมูลไม่สำเร็จ")</script>';
        header('Refresh:0; url= ../frmUpdateReservation.php');
    }
}
mysqli_close($conn);
?>
