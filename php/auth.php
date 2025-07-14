<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    if ($action == "register") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Check if email already exists
        $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        if (mysqli_num_rows($check) > 0) {
            echo "<script>alert('Email already registered!'); window.location.href='index.php';</script>";
            exit;
        } else {
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Registration successful!'); window.location.href='index.php';</script>";
                exit;
            } else {
                echo "Error: " . mysqli_error($conn);
                exit;
            }
        }

    } elseif ($action == "login") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['user'] = $row['username'];
                echo "<script>alert('Login successful!'); window.location.href='dashboard.php';</script>";
                exit;
            } else {
                echo "<script>alert('Incorrect password'); window.location.href='index.php';</script>";
                exit;
            }
        } else {
            echo "<script>alert('User not found'); window.location.href='index.php';</script>";
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login & Register</title>
    <link rel="stylesheet" href="style.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet' />
</head>

<body>
    <div class="background-overlay"></div>

    <div class="wrapper">
        <span class="bg-animate"></span>
        <span class="bg-animate2"></span>

        <!-- LOGIN FORM -->
        <div class="form-box login">
            <h2 class="animation" style="--i:0; --j:21">Login</h2>
            <form action="" method="POST">
                <input type="hidden" name="action" value="login" />
                <div class="input-box animation" style="--i:1; --j:22">
                    <input type="text" name="username" required />
                    <label>Username</label>
                    <i class='bx bxs-user'></i>
                </div>

                <div class="input-box animation" style="--i:2; --j:23">
                    <input type="password" name="password" required />
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

        <!-- SIGN UP FORM -->
        <div class="form-box register">
            <h2 class="animation" style="--i:17; --j:0">Sign Up</h2>
            <form action="" method="POST">
                <input type="hidden" name="action" value="register" />
                <div class="input-box animation" style="--i:18; --j:1">
                    <input type="text" name="username" required />
                    <label>Username</label>
                    <i class='bx bxs-user'></i>
                </div>

                <div class="input-box animation" style="--i:19; --j:2">
                    <input type="email" name="email" required />
                    <label>Email</label>
                    <i class='bx bx-envelope'></i>
                </div>

                <div class="input-box animation" style="--i:20; --j:3">
                    <input type="password" name="password" required />
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

    <script src="script.js"></script>
</body>

</html>
