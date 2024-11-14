<?php 

    session_start();
     include('connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="images/logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
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
        <div class="w-1/2 p-8">
            <div class="flex justify-center mt-20 mb-5">
                <img src="images/logo.png" alt="Image" class="w-44 ">
            </div>
            <div class="text-center mb-7">
                <h1 class="font-medium text-xl">Welcome to BongCPU</h1>
                <p class="font-normal  text-xl mb-12">"ใครๆก็มีคอมได้"</p>
            </div>
            

                <form action="login_db.php" method="post">
                <?php if (isset($_SESSION['error'])) : ?>
            <div class="error">
                <h3>
                    <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        
                  <!--Username input-->
                  <div for="username" class="relative mb-4">
                  <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Username</label> 
                    <input
                      type="text" name="username"
                      placeholder="Username"  class="w-full p-2 border border-gray-300 rounded mt-2"/>
                   
                  </div>

                  <!--Password input-->
                  <div class="relative mb-4" >
                  <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Password</label> 
                    <input
                      type="password" name="password"
                      placeholder="••••••••" class="w-full p-2 border border-gray-300 rounded mt-2"
                       />
                    
                  </div>

                  <!--Submit button-->
                  <div class="mb-5 pb-1 pt-1 text-center mt-8">
                    <button  type="submit" name="login" 
                      class="w-full bg-blue-500 text-white py-2 rounded hover:bg-amber-300"
                      >
                      Log in
                    </button>

                    <!--Forgot password link-->
                    
                  </div>

                  <!--Register button-->
                  <p class="text-sm font-light text-gray-500 dark:text-gray-400 text-center">
                        ไม่มีบัญชี ? <a href="frm_register.php" class="font-medium text-primary-600 hover:underline text-[#776B5D]">ลงทะเบียน</a>
                </form>
              </div>
            

            <!-- Right column container with background and description-->
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
    </div>
          </div>
        </div>
      </div>
    </div>
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

        // Auto play slider every 3 seconds
        setInterval(() => {
            nextSlide();
        }, 5000); // Change the interval time as needed
    </script>


</body>
</html>