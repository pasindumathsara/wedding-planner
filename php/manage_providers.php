<?php
include 'db.php';

if (!isset($_GET['category'])) {
    echo "Category not selected.";
    exit;
}

$category = $_GET['category'];

// Fetch providers of this category
$sql = "SELECT * FROM providers WHERE service_type = '$category'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Manage Providers - <?php echo htmlspecialchars($category); ?></title>
  <style>
    body { font-family: Arial, sans-serif; padding: 30px; background:#f5f5f5; }
    h2 { margin-bottom: 20px; }
    table {
      width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 0 10px #aaa;
    }
    th, td {
      padding: 12px 15px; border-bottom: 1px solid #ddd; text-align: left;
    }
    th {
      background: #ee9ca7; color: white;
    }
    a.button {
      padding: 7px 12px; background: #ee9ca7; color: white; border-radius: 6px; text-decoration: none; font-size: 14px;
      margin-right: 5px;
    }
    a.button:hover { background: #e5738c; }
    .top-bar {
      margin-bottom: 15px;
    }
  </style>
</head>
<body>

  <div class="top-bar">
    <h2>Manage Providers - <?php echo htmlspecialchars($category); ?></h2>
    <a href="add_provider.php?category=<?php echo urlencode($category); ?>" class="button">+ Add New Provider</a>
    <a href="select_category.php" class="button" style="background:#aaa;">Change Category</a>
  </div>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['phone']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td>
              <a href="edit_provider.php?id=<?php echo $row['id']; ?>" class="button">Edit</a>
              <a href="delete_provider.php?id=<?php echo $row['id']; ?>" class="button" onclick="return confirm('Are you sure to delete this provider?');" style="background:#d9534f;">Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="5" style="text-align:center;">No providers found in this category.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>

</body>
</html>
