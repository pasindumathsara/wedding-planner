<?php
include 'db.php';
include 'adminheader.php';

$category = isset($_GET['category']) ? $_GET['category'] : null;

if ($category) {
    // Fetch providers of this category
    $sql = "SELECT * FROM providers WHERE service_type = '$category'";
    $result = mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Manage Providers<?php echo $category ? ' - ' . htmlspecialchars($category) : ''; ?></title>
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
      background: #b76e79; color: white;
    }
    a.button {
      padding: 7px 12px; background: #b76e79; color: white; border-radius: 6px; text-decoration: none; font-size: 14px;
      margin-right: 5px;
    }
    a.button:hover { background: #714a50ff; }
    .top-bar { margin-bottom: 15px; }

    /* Modal styles */
    .modal {
      display: none; position: fixed; z-index: 999; left: 0; top: 0; width: 100%; height: 100%;
      background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center;
    }
    .modal-content {
      background-color: white; padding: 30px; border-radius: 10px; max-width: 400px; width: 90%; box-shadow: 0 0 10px #333;
    }
    .modal select, .modal button {
      width: 100%; padding: 10px; font-size: 16px; margin-top: 10px; border-radius: 6px; border: 1px solid #ccc;
    }
    .modal button {
      background: #b76e79; color: white; border: none; cursor: pointer;
    }
    .modal button:hover { background: rgba(98, 13, 31, 1); }
  </style>
</head>
<body>

<div class="top-bar">
  <br><br><br><br>  <br><br><br><br>
  <h2>Manage Providers<?php echo $category ? ' - ' . htmlspecialchars($category) : ''; ?></h2>
  <?php if ($category): ?>
    <a href="#" onclick="openModal()" class="button" style="background:#aaa;">Change Category</a>
    <a href="add_provider.php?category=<?php echo urlencode($category); ?>" class="button">+ Add New Provider</a>
  <?php endif; ?>
</div>

<?php if ($category): ?>
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
<?php endif; ?>

<!-- Category Selection Modal -->
<div class="modal" id="categoryModal">
  <div class="modal-content">
    <h3 style="text-align:center;">Select Provider Category</h3>
    <form method="GET" action="">
      <select name="category" required>
        <option value="" disabled selected>Select category</option>
        <option value="Photographer">Photographer</option>
        <option value="Caterer">Caterer</option>
        <option value="Venue">Venue</option>
        <option value="Makeup">Makeup</option>
        <!-- Add more categories if needed -->
      </select>
      <button type="submit">Manage</button>
    </form>
  </div>
</div>

<script>
  function openModal() {
    document.getElementById('categoryModal').style.display = 'flex';
  }

  // Open modal if category is not set
  <?php if (!$category): ?>
    window.onload = openModal;
  <?php endif; ?>
</script>

</body>
</html>
