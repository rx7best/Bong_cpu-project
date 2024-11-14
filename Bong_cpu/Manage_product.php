<?php 
    require_once('connect.php');
    $sql = "SELECT * FROM product";
    $result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <!-- favicons -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Css -->
    
    
</head>
<?php require("menu_admin.php"); ?>
<body class="bg-cover bg-center h-screen bg-opacity-25" style="background-image:url(images/bgw.png);">
    

<style>
    	th{
            border: 1px solid #000000;
            padding: 8px;
            background:#fff3b0;
            
        }
        td{
            border: 1px solid #000000;
            padding: 8px;
            background:#FFFFFF ; 
        }

    </style>
<body>
    

                <div class="row justify-content-center">
                <div class="container mx-auto px-3 mt-2">
                    <div class="text-4xl font-extrabold text-gray-900 dark:text-stone mt-6 ml-5 mb-6"> Manage Product</div>
                        
                           
                    
                    <div class="flex justify-center">
                        <div class="table-responsive" >
                            <?php if (mysqli_num_rows($result) > 0): ?>
                            <table class="table table-bordered">
                                <thead>
                                <tr class="text-center text-light bg-dark">
                                  
                                    <th>ชื่อสินค้า</th>
                                    <th>ประเภทสินค้า</th>
                                    <th>รูปภาพ</th>
                                    <th>ราคา</th>
                                    <th>การจัดการ</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)):?>
                                    <tr class="text-center">
                                        
                                        <td> <?php echo $row['product_name'] ?> </td>
                                        <td> <?php 
                                            if ($row['type_id'] == 1) {
                                                echo "ไม่มีการ์ดจอแยก/non GPU";
                                            } elseif ($row['type_id'] == 2) {
                                                echo "มีการ์ดจอแยก/Have GPU";
                                            }
                                        ?> </td>
                                        <td> <?php echo $row['images'] ?> </td>
                                        <td> <?php echo $row['price'] ?> </td>
                                        
                                        <td>
                                            <div class="btn-group">
                                               
                                               <button class="text-stone  bg-[#fce568] hover:bg-[#FFD700] focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800   dark:shadow-lg dark:shadow-stone-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 "><a href="frmupproduct.php?id=<?php echo $row['product_id'] ?>" class="btn btn-warning"> แก้ไข </a></button>
                                               <button class="text-stone  bg-[#FF8772] hover:bg-[#FC3F1E] focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800   dark:shadow-lg dark:shadow-stone-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 "> <a href="del_product.php?id=<?php echo $row['product_id'] ?>" class="btn btn-danger"> ลบ </a></button>
                                               
                                            </div>
                                        </td>
                                    </tr>
                                    
                                <?php endwhile; ?>
                                </tbody>
                            </table>    
                            <?php 
                                else: 
                                    echo "<p class='mt-5'>ไม่มีข้อมูลในฐานข้อมูล</p>"; 
                                endif; 
                            ?>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
           
        
    
    
    
    
    <?php mysqli_close($conn) ?>
    
    


</body>
</html>