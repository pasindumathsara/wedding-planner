<?php include 'db.php'; 
include 'adminheader.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Wedding Package</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: 'Inter', sans-serif;
      background: linear-gradient(to right, #f9f4f4, #fff3f3);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .form-wrapper {
      width: 95%;
      max-width: 900px;
      background: white;
      padding: 40px;
      border-radius: 25px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      animation: fadeIn 1s ease-in-out;
      position: relative;
      top:120px;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h2 {
      text-align: center;
      color: #b76e79;
      margin-bottom: 30px;
    }

    .section {
      margin-bottom: 30px;
      border-bottom: 1px solid #eee;
      padding-bottom: 25px;
    }

    .section:last-child {
      border: none;
    }

    .section-title {
      font-size: 20px;
      font-weight: bold;
      color: #555;
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      font-weight: 600;
      display: block;
      margin-bottom: 8px;
      color: #444;
    }

    input[type="text"],
    input[type="number"],
    select,
    textarea,
    input[type="file"] {
      width: 100%;
      padding: 14px;
      font-size: 15px;
      border: 2px solid #ddd;
      border-radius: 12px;
      transition: border-color 0.3s;
    }

    input:focus,
    select:focus,
    textarea:focus {
      border-color: #f06292;
      outline: none;
    }

    textarea {
      resize: vertical;
      min-height: 100px;
    }

    .btn {
      background-color: #b76e79;
      color: white;
      border: none;
      padding: 14px 22px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      border-radius: 12px;
      width: 100%;
      transition: background 0.3s ease-in-out;
    }

    .btn:hover {
      background-color: #1c0009ff;
    }

    .preview img {
      margin-top: 10px;
      max-width: 150px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .icon-divider {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }

    .icon-divider i {
      margin-right: 10px;
      font-size: 20px;
      color: #f06292;
    }

    @media (max-width: 600px) {
      .form-wrapper {
        padding: 25px;
      }
    }
  </style>
</head>
<body>

<div class="form-wrapper">
  <h2><i class="fas fa-heart"></i> Add a New Wedding Package</h2>
  <form action="process_add_package.php" method="POST" enctype="multipart/form-data">

    <!-- Section 1: Basic Info -->
    <div class="section">
      <div class="icon-divider"><i class="fas fa-info-circle"></i><span class="section-title">Basic Details</span></div>

      <div class="form-group">
        <label for="title">Package Title</label>
        <input type="text" name="title" id="title" placeholder="e.g., Golden Dreams" required>
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" placeholder="Describe your wedding package..." required></textarea>
      </div>

      <div class="form-group">
        <label for="price">Price (LKR)</label>
        <input type="number" name="price" id="price" step="0.01" placeholder="e.g., 250000" required>
      </div>
    </div>

    <!-- Section 2: Service Providers -->
    <div class="section">
      <div class="icon-divider"><i class="fas fa-users"></i><span class="section-title">Service Providers</span></div>

      <div class="form-group">
        <label for="photographer_id">Photographer</label>
        <select name="photographer_id" id="photographer_id" required>
          <option value="">Select Photographer</option>
          <?php
          $result = mysqli_query($conn, "SELECT id, name FROM providers WHERE service_type='Photographer'");
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<option value='{$row['id']}'>{$row['name']}</option>";
          }
          ?>
        </select>
      </div>

      <div class="form-group">
        <label for="caterer_id">Caterer</label>
        <select name="caterer_id" id="caterer_id" required>
          <option value="">Select Caterer</option>
          <?php
          $result = mysqli_query($conn, "SELECT id, name FROM providers WHERE service_type='Caterer'");
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<option value='{$row['id']}'>{$row['name']}</option>";
          }
          ?>
        </select>
      </div>

      <div class="form-group">
        <label for="venue_id">Venue</label>
        <select name="venue_id" id="venue_id" required>
          <option value="">Select Venue</option>
          <?php
          $result = mysqli_query($conn, "SELECT id, name FROM providers WHERE service_type='Venue'");
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<option value='{$row['id']}'>{$row['name']}</option>";
          }
          ?>
        </select>
      </div>

      <div class="form-group">
        <label for="makeup_id">Makeup Artist</label>
        <select name="makeup_id" id="makeup_id" required>
          <option value="">Select Makeup Artist</option>
          <?php
          $result = mysqli_query($conn, "SELECT id, name FROM providers WHERE service_type='Makeup'");
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<option value='{$row['id']}'>{$row['name']}</option>";
          }
          ?>
        </select>
      </div>
    </div>

    <!-- Section 3: Image Upload -->
    <div class="section">
      <div class="icon-divider"><i class="fas fa-image"></i><span class="section-title">Upload Package Image</span></div>
      <div class="form-group">
        <label for="image">Choose an image</label>
        <input type="file" name="image" id="image" accept="image/*" onchange="previewImage(event)" required>
        <div class="preview" id="previewBox" style="display: none;">
          <img id="previewImage" alt="Image Preview">
        </div>
      </div>
    </div>

    <!-- Submit -->
    <div class="section">
      <button type="submit" name="submit" class="btn"><i class="fas fa-plus-circle"></i> Add Package</button>
    </div>

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
