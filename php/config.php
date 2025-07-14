<?php
$conn = mysqli_connect("localhost", "root", "", 'WeddingPlanner');


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
