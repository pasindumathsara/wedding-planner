<?php
include 'db.php';  // Adjust path as needed

if (isset($_POST['submit'])) {
    // Get form values and sanitize
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = floatval($_POST['price']);

    $photographer_id = intval($_POST['photographer_id']);
    $caterer_id = intval($_POST['caterer_id']);
    $venue_id = intval($_POST['venue_id']);
    $makeup_id = intval($_POST['makeup_id']);

    // Handle image upload
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    $upload_dir = "../uploads/";
    $target_file = $upload_dir . basename($image_name);

    // Move uploaded file
    if (move_uploaded_file($image_tmp, $target_file)) {
        // Insert data into wedding_packages
        $sql = "INSERT INTO wedding_packages
            (title, description, price, photographer_id, caterer_id, venue_id, makeup_id, main_image)
            VALUES
            ('$title', '$description', $price, $photographer_id, $caterer_id, $venue_id, $makeup_id, '$image_name')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Wedding package added successfully!'); window.location.href = '../html/dashboard.html';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Failed to upload image.";
    }
} else {
    echo "Invalid access.";
}
?>
