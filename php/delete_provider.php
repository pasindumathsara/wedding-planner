<?php
include 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Invalid provider ID");
}

// Get provider category before deleting
$sql_get = "SELECT service_type FROM providers WHERE id = $id";
$result = mysqli_query($conn, $sql_get);
$provider = mysqli_fetch_assoc($result);

if (!$provider) {
    die("Provider not found");
}

$category = $provider['service_type'];

$sql = "DELETE FROM providers WHERE id = $id";
if (mysqli_query($conn, $sql)) {
    header("Location: manage_providers.php?category=" . urlencode($category));
} else {
    echo "Error deleting provider: " . mysqli_error($conn);
}
?>
