<?php session_start(); ?> <!-- Start PHP session to manage login state -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"> <!-- Set character encoding -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Ensure compatibility with IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive layout -->
    <title>Login & Register</title>

    <!-- External CSS file for styling -->
    <link rel="stylesheet" href="style.css">

    <!-- Boxicons icon library -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <!-- Background overlay for visual effect -->
    <div class="background-overlay"></div>

    <!-- Main container for login and register forms -->
    <div class="wrapper">
        <!-- Background animations -->
        <span class="bg-animate"></span>
        <span class="bg-animate2"></span>

        <!-- LOGIN FORM -->
        <div class="form-box login">
            <h2 class="animation" style="--i:0; --j:21">Login</h2>

           
            <form action="auth.php" method="POST">
                
                <input type="hidden" name="action" value="login">

               
                <div class="input-box animation" style="--i:1; --j:22">
                    <input type="text" name="username" required>
                    <label>Username</label>
                    <i class='bx bxs-user'></i> 
                </div>

                <div class="input-box animation" style="--i:2; --j:23">
                    <input type="password" name="password" required>
                    <label>Password</label>
                    <i class='bx bxs-lock'></i> 
                </div>

                
                <button type="submit" class="btn animation" style="--i:3; --j:24">Login</button>

                
                <div class="logreg-link animation" style="--i:4; --j:25">
                    <p>Don't have an account? <a href="#" class="register-link">Sign Up</a></p>
                </div>
            </form>
        </div>

        
        <div class="info-text login">
            <h2 class="animation" style="--i:0; --j:20">Welcome!</h2>
            <p class="animation" style="--i:1; --j:21">Here is the best place to organize your future dream !!</p>
        </div>

        <!-- REGISTER FORM -->
        <div class="form-box register">
            <h2 class="animation" style="--i:17; --j:0">Sign Up</h2>

          
            <form action="auth.php" method="POST">
                
                <input type="hidden" name="action" value="register">

              
                <div class="input-box animation" style="--i:18; --j:1">
                    <input type="text" name="username" required>
                    <label>Username</label>
                    <i class='bx bxs-user'></i>
                </div>

            
                <div class="input-box animation" style="--i:19; --j:2">
                    <input type="email" name="email" required>
                    <label>Email</label>
                    <i class='bx bx-envelope'></i>
                </div>

                
                <div class="input-box animation" style="--i:20; --j:3">
                    <input type="password" name="password" required>
                    <label>Password</label>
                    <i class='bx bxs-lock'></i>
                </div>

               
                <button type="submit" class="btn animation" style="--i:21; --j:4">Sign Up</button>

               
                <div class="logreg-link animation" style="--i:22; --j:5">
                    <p>Already have an account? <a href="#" class="login-link">Login</a></p>
                </div>
            </form>
        </div>

        
        <div class="info-text register">
            <h2 class="animation" style="--i:17; --j:0">Welcome Back!</h2>
            <p class="animation" style="--i:18; --j:1">Here is the best place to organize your future dream !!</p>
        </div>
    </div>

   
    <script>
        const wrapper = document.querySelector('.wrapper'); 
        const loginLink = document.querySelector('.login-link'); 
        const registerLink = document.querySelector('.register-link'); 

        registerLink.addEventListener('click', () => {
            wrapper.classList.add('active'); 
        });

       
        loginLink.addEventListener('click', () => {
            wrapper.classList.remove('active'); 
        });
    </script>
</body>

</html>
