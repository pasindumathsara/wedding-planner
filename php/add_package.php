<?php
include 'db.php'; // Your DB connection file
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Add Wedding Package</title>
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    body {
      background: linear-gradient(to right, #ffdde1, #ee9ca7);
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: 60px auto;
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
      padding: 30px 40px;
      animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(-30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 25px;
      font-size: 28px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      font-weight: bold;
      display: block;
      margin-bottom: 6px;
      color: #555;
    }

    input[type='text'],
    input[type='number'],
    textarea,
    input[type='file'],
    select {
      width: 100%;
      padding: 12px;
      border: 2px solid #ccc;
      border-radius: 8px;
      font-size: 15px;
      transition: border-color 0.3s;
    }

    input:focus,
    textarea:focus,
    select:focus {
      border-color: #ee9ca7;
      outline: none;
    }

    textarea {
      resize: vertical;
      min-height: 100px;
    }

    .btn {
      width: 100%;
      padding: 12px;
      background: #ee9ca7;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .btn:hover {
      background: #e5738c;
    }

    .upload-preview {
      margin-top: 15px;
      text-align: center;
    }

    .upload-preview img {
      width: 120px;
      height: auto;
      border-radius: 10px;
      margin-top: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>
  <div class="container">
    <h2><i class="fas fa-gift"></i> Add Wedding Package</h2>
    <form action="process_add_package.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="title">Package Title</label>
        <input
          type="text"
          name="title"
          id="title"
          placeholder="e.g., Gold Package"
          required
        />
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <textarea
          name="description"
          id="description"
          placeholder="Write details about this wedding package..."
          required
        ></textarea>
      </div>

      <div class="form-group">
        <label for="price">Price (LKR)</label>
        <input
          type="number"
          step="0.01"
          name="price"
          id="price"
          placeholder="e.g., 250000"
          required
        />
      </div>

      <!-- Provider Selection -->
      <div class="form-group">
        <label for="photographer_id">Select Photographer</label>
        <select name="photographer_id" id="photographer_id" required>
          <option value="">-- Select Photographer --</option>
          <?php
          $result = mysqli_query($conn, "SELECT id, name FROM providers WHERE service_type='Photographer'");
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<option value='{$row['id']}'>{$row['name']} (ID: {$row['id']})</option>";
          }
          ?>
        </select>
      </div>

      <div class="form-group">
        <label for="caterer_id">Select Caterer</label>
        <select name="caterer_id" id="caterer_id" required>
          <option value="">-- Select Caterer --</option>
          <?php
          $result = mysqli_query($conn, "SELECT id, name FROM providers WHERE service_type='Caterer'");
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<option value='{$row['id']}'>{$row['name']} (ID: {$row['id']})</option>";
          }
          ?>
        </select>
      </div>

      <div class="form-group">
        <label for="venue_id">Select Venue</label>
        <select name="venue_id" id="venue_id" required>
          <option value="">-- Select Venue --</option>
          <?php
          $result = mysqli_query($conn, "SELECT id, name FROM providers WHERE service_type='Venue'");
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<option value='{$row['id']}'>{$row['name']} (ID: {$row['id']})</option>";
          }
          ?>
        </select>
      </div>

      <div class="form-group">
        <label for="makeup_id">Select Makeup Artist</label>
        <select name="makeup_id" id="makeup_id" required>
          <option value="">-- Select Makeup Artist --</option>
          <?php
          $result = mysqli_query($conn, "SELECT id, name FROM providers WHERE service_type='Makeup'");
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<option value='{$row['id']}'>{$row['name']} (ID: {$row['id']})</option>";
          }
          ?>
        </select>
      </div>

      <div class="form-group">
        <label for="image">Upload Package Image</label>
        <input
          type="file"
          name="image"
          id="image"
          accept="image/*"
          onchange="previewImage(event)"
          required
        />
        <div class="upload-preview" id="previewBox" style="display: none;">
          <p>Preview:</p>
          <img id="previewImage" alt="Image Preview" />
        </div>
      </div>

      <button type="submit" name="submit" class="btn">Add Package</button>
    </form>
  </div>

  <script>
    function previewImage(event) {
      const image = document.getElementById('image').files[0];
      if (image) {
        const preview = document.getElementById('previewImage');
        const previewBox = document.getElementById('previewBox');
        preview.src = URL.createObjectURL(image);
        previewBox.style.display = 'block';
      }
    }
  </script>
</body>
</html>
