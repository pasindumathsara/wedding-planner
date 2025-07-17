<?php
include 'db.php';

$category = $_GET['category'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $service_type = mysqli_real_escape_string($conn, $_POST['service_type']);

    $sql = "INSERT INTO providers (name, phone, email, service_type) VALUES ('$name', '$phone', '$email', '$service_type')";
    if (mysqli_query($conn, $sql)) {
        header("Location: manage_providers.php?category=" . urlencode($service_type));
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
  <title>Add Provider</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 30px; background:#f5f5f5; }
    .container {
      max-width: 400px; margin: auto; background: white; padding: 30px;
      border-radius: 10px; box-shadow: 0 0 10px #aaa;
    }
    h2 { margin-bottom: 20px; }
    input, select {
      width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 6px;
      border: 1px solid #ccc; font-size: 16px;
    }
    button {
      width: 100%; padding: 12px; background: #ee9ca7; color: white;
      border: none; font-size: 16px; border-radius: 6px; cursor: pointer;
    }
    button:hover { background: #e5738c; }
    .error { color: red; margin-bottom: 15px; }
  </style>
</head>
<body>
  <div class="container">
    <h2>Add New Provider</h2>

    <?php if (!empty($error)): ?>
      <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST" action="">
      <input type="hidden" name="service_type" value="<?php echo htmlspecialchars($category); ?>" />
      <label>Name</label>
      <input type="text" name="name" required />
      <label>Phone</label>
      <input type="text" name="phone" required />
      <label>Email</label>
      <input type="email" name="email" required />
      <button type="submit">Add Provider</button>
    </form>

    <p><a href="manage_providers.php?category=<?php echo urlencode($category); ?>">Back to Providers List</a></p>
  </div>
</body>
</html>
