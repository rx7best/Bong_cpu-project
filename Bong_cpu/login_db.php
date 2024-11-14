<?php 
session_start();
include('connect.php');

$errors = array();

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['user_id']; // บันทึก user_id ลงในเซสชัน
            header("location: home.php");
            exit();
        } else {
            echo '<script> alert("ชื่อผู้ใช้หรือรหัสผ่านผิด")</script>';
            header('Refresh:0; url= frm_login.php');
            exit();
        }
    } 
}
?>
