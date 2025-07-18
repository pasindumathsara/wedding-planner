<?php
include 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Invalid provider ID");
}

$sql = "SELECT * FROM providers WHERE id = $id";
$result = mysqli_query($conn, $sql);
$provider = mysqli_fetch_assoc($result);

if (!$provider) {
    die("Provider not found");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $price_range = mysqli_real_escape_string($conn, $_POST['price_range']);
    $experience = mysqli_real_escape_string($conn, $_POST['experience']);
    $service_locations = mysqli_real_escape_string($conn, $_POST['service_locations']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $sql = "UPDATE providers SET 
                name='$name', 
                phone='$phone', 
                email='$email', 
                price_range='$price_range', 
                experience='$experience', 
                service_locations='$service_locations',
                description='$description'
            WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: manage_providers.php?category=" . urlencode($provider['service_type']));
        exit;
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Edit Provider</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 30px; background:#f5f5f5; }
    .container {
      max-width: 500px; margin: auto; background: white; padding: 30px;
      border-radius: 10px; box-shadow: 0 0 10px #aaa;
    }
    h2 { margin-bottom: 20px; }
    input, textarea {
      width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 6px;
      border: 1px solid #ccc; font-size: 16px;
    }
    button {
      width: 100%; padding: 12px; background: #b76e79; color: white;
      border: none; font-size: 16px; border-radius: 6px; cursor: pointer;
    }
    button:hover { background: #824b53ff; }
    .error { color: red; margin-bottom: 15px; }
  </style>
</head>
<body>
  <div class="container">
    <h2>Edit Provider</h2>

    <?php if (!empty($error)): ?>
      <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST" action="">
      <label>Name</label>
      <input type="text" name="name" value="<?php echo htmlspecialchars($provider['name']); ?>" required />

      <label>Phone</label>
      <input type="text" name="phone" value="<?php echo htmlspecialchars($provider['phone']); ?>" required />

      <label>Email</label>
      <input type="email" name="email" value="<?php echo htmlspecialchars($provider['email']); ?>" required />

      <label>Price Range</label>
      <input type="text" name="price_range" value="<?php echo htmlspecialchars($provider['price_range']); ?>" required />

      <label>Experience (years)</label>
      <input type="number" name="experience" value="<?php echo htmlspecialchars($provider['experience']); ?>" required />

      <label>Location</label>
      <input type="text" name="service_locations" value="<?php echo htmlspecialchars($provider['service_locations']); ?>" required />

      <label>Description</label>
      <textarea name="description" rows="4" required><?php echo htmlspecialchars($provider['description']); ?></textarea>

      <button type="submit">Save Changes</button>
    </form>

    <p><a href="manage_providers.php?category=<?php echo urlencode($provider['service_type']); ?>">Back to Providers List</a></p>
  </div>
</body>
</html>
