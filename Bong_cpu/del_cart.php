<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>del_cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    
</body>
</html>
<?php
require_once('connect.php');

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "DELETE FROM cart WHERE cart_id = '$id'";
    
    if (mysqli_query($conn, $sql)) {
        echo '<script>
            Swal.fire({
                title: "Success!",
                text: "Data has been successfully deleted.",
                icon: "success",
                timer: 3000,
                showConfirmButton: false
            }).then(function() {
                window.location.href = "frmManagecart.php";
            });
        </script>';
    } else {
        echo '<script>
            Swal.fire({
                title: "Error!",
                text: "Failed to delete data.",
                icon: "error",
                timer: 3000,
                showConfirmButton: false
            }).then(function() {
                window.location.href = "../";
            });
        </script>';
    }
}

mysqli_close($conn);
?>
