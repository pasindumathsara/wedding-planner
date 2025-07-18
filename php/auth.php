<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

   
    if ($action === "register") {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $check = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

        if ($check) {
            if (mysqli_num_rows($check) > 0) {
                echo "<script>alert('❌ Email already registered!'); window.history.back();</script>";
            } else {
                $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
                if (mysqli_query($conn, $sql)) {
                    echo "<script>
                        alert('✅ Registered successfully.');
                        window.location.href = 'index.php';
                    </script>";
                } else {
                    echo "<script>alert('❌ Registration failed: " . mysqli_error($conn) . "'); window.history.back();</script>";
                }
            }
        } else {
            echo "<script>alert('❌ Query error: " . mysqli_error($conn) . "'); window.history.back();</script>";
        }
    }

   
    if ($action === "login") {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $user = mysqli_fetch_assoc($result);

            if ($user && $password === $user['password']) {
                $_SESSION['username'] = $user['username'];
                echo "<script>
                    alert('✅ Login successful. Welcome, " . $user['username'] . "');
                    window.location.href = 'home.php';
                </script>";
            } else {
                echo "<script>alert('❌ Invalid username or password.'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('❌ Query error: " . mysqli_error($conn) . "'); window.history.back();</script>";
        }
    }
}
?>
