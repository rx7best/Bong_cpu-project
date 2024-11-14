<?php include('connect.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" type="x-icon" href="images/logo.png">
<script src="https://cdn.tailwindcss.com"></script>
<title>Register</title>
<style>
        body {
            background-image: url('images/bgg1.png');
            background-size: cover; 
            background-position: center; 
            
        }
    </style>
</head>
<body class="h-screen flex items-center justify-center backdrop-blur-[5px]">
    <div class="flex w-full max-w-7xl bg-white rounded-lg shadow-lg">
        

        <!-- Right Side (Image Slider) -->
        <div class="relative w-1/2 h-full overflow-hidden mt-5">
            <div class="flex transition-transform duration-500" style="transform: translateX(0%);" id="carousel">
                <!-- Slide 1 -->
                <div class="w-full flex-none">
                    <img src="images/bg1.jpg" alt="Image 1" class="w-full h-full rounded-r-lg">
                </div>
                <!-- Slide 2 -->
                <div class="w-full flex-none">
                    <img src="images/bg3.jpg" alt="Image 2" class="w-full h-full rounded-r-lg">
                </div>
                <!-- Slide 3 -->
                <div class="w-full flex-none">
                    <img src="images/bg4.jpg" alt="Image 3" class="w-full h-full rounded-r-lg">
                </div>
            </div>
        </div>
<div class="w-1/2 p-8">   
    <div class="flex justify-center  ">
        <img src="images/logo.png" alt="Image" class="w-44 ">
    </div>
    <div class="text-center mt-7">
        <p class="mb-4 text-gray-600 ">Register/ลงทะเบียน</p>
    </div>

  <form class="space-y-4 md:space-y-6" action="register_db.php" method="post" >
                    <div>
                          <!-- ยูสเซอร์ -->
                      <label class="block  text-sm font-medium text-gray-900 dark:text-black">Username</label>
                      <input type="text" name="username" class="w-full p-2 border border-gray-300 rounded mt-2"
                        placeholder="your-email@gmail.com"  >
                  </div>
                    <div>  
                          <!-- ชื่อ -->
                      <label  class="block  text-sm font-medium text-gray-900 dark:text-black">Name</label>
                      <input type="text" name="owner_name"  class="w-full p-2 border border-gray-300 rounded mt-2">
                  </div>
                  
                    <div>  
                         
                    <label  class="block  text-sm font-medium text-gray-900 dark:text-black">Address</label>
                      <input type="text" name="address"  class="w-full p-2 border border-gray-300 rounded mt-2" >
                  </div>
                  <div>
                      <!-- รหัสผ่าน -->
                        <label class="block  text-sm font-medium text-gray-900 dark:text-black">Password</label>
                        <input type="password" name="password" class="w-full p-2 border border-gray-300 rounded mt-2"
                        placeholder="••••••••" >
                    </div>
                    
                    
                    <div class="mt-6">
                        
                    </div>
                    <div class="flex justify-center">
                      <button type="submit" name="send" value="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-amber-300"
                      
                      >Create your account</button></a> 
                    </div>
            
                    
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400 text-center">
                        มีบัญชีแล้ว ? <a href="frm_login.php" class="font-medium text-primary-600 hover:underline text-[#776B5D]">เข้าสู่ระบบ</a>
                    </p>
                </form>
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

        // Auto play slider every 3 seconds
        setInterval(() => {
            nextSlide();
        }, 5000); // Change the interval time as needed
    </script>

</body>
</html>

