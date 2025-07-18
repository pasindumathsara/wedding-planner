<?php
include 'db.php';
include 'adminheader.php';

$category = $_GET['category'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $service_type = mysqli_real_escape_string($conn, $_POST['service_type']);
    $service_locations = isset($_POST['service_locations']) ? implode(',', $_POST['service_locations']) : '';
    $price_range = mysqli_real_escape_string($conn, $_POST['price_range']);
    $experience = mysqli_real_escape_string($conn, $_POST['experience']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Optional: handle file upload here if needed

    $sql = "INSERT INTO providers (name, phone, email, service_type, service_locations, price_range, experience, description)
            VALUES ('$name', '$phone', '$email', '$service_type', '$service_locations', '$price_range', '$experience', '$description')";

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
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add New Provider</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      padding: 40px;
    }

    .container {
      max-width: 1100px;
      margin: auto;
    }

    .form-header {
      text-align: center;
      margin-bottom: 30px;
    }

    .form-header h1 {
      font-size: 28px;
      margin-bottom: 10px;
    }

    .form-steps {
      display: flex;
      justify-content: center;
      margin-bottom: 30px;
    }

    .form-step {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin: 0 15px;
      color: #bbb;
    }

    .form-step.active {
      color: #b76e79;
    }

    .form-step .circle {
      width: 30px;
      height: 30px;
      background: currentColor;
      border-radius: 50%;
      text-align: center;
      line-height: 30px;
      color: white;
      font-weight: bold;
    }

    .form-layout {
      background: white;
      border-radius: 10px;
      padding: 30px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .step-section {
      display: none;
    }

    .step-section.active {
      display: block;
      animation: fadeIn 0.5s ease-in-out;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-label {
      display: block;
      font-weight: bold;
      margin-bottom: 6px;
    }

    .form-control {
      width: 100%;
      padding: 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 16px;
    }

    .submit-button,
    .nav-button {
      margin-top: 20px;
      padding: 12px;
      background: #b76e79;
      color: white;
      border: none;
      font-size: 16px;
      border-radius: 6px;
      cursor: pointer;
    }

    .submit-button:hover,
    .nav-button:hover {
      background: #8e3f50;
    }

    .button-group {
      display: flex;
      justify-content: space-between;
    }

    .error {
      color: red;
      margin-bottom: 20px;
      text-align: center;
    }

    .back-link {
      display: block;
      margin-top: 20px;
      text-align: center;
      color: #666;
    }

    .back-link:hover {
      text-decoration: underline;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

<div class="container">

  <div class="form-header">
      <br><br><br><br><br><br><br>
    <h1>Add New Provider</h1>
    <p>Fill in the details to register a new provider under <strong><?php echo htmlspecialchars($category); ?></strong></p>
  </div>

  <div class="form-steps">
    <div class="form-step step-1 active">
      <div class="circle">1</div>
      <div class="label">Basic Info</div>
    </div>
    <div class="form-step step-2">
      <div class="circle">2</div>
      <div class="label">More Details</div>
    </div>
  </div>

  <?php if (!empty($error)): ?>
    <div class="error"><?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>

  <form method="POST" action="">
    <input type="hidden" name="service_type" value="<?php echo htmlspecialchars($category); ?>" />

    <div class="form-layout">
      <!-- Step 1 -->
      <div class="step-section step-1 active">
        <div class="form-group">
          <label class="form-label">Provider Name</label>
          <input type="text" name="name" class="form-control" required />
        </div>

        <div class="form-group">
          <label class="form-label">Phone Number</label>
          <input type="text" name="phone" class="form-control" required />
        </div>

        <div class="form-group">
          <label class="form-label">Email Address</label>
          <input type="email" name="email" class="form-control" required />
        </div>

        <div class="button-group">
          <button type="button" class="nav-button" onclick="nextStep()">Next</button>
        </div>
      </div>

      <!-- Step 2 -->
      <div class="step-section step-2">
        <div class="form-group">
          <label class="form-label">Location</label>
          <input type="text" name="location" class="form-control" required />
        </div>

        <div class="form-group">
          <label class="form-label">Price Range (LKR)</label>
          <input type="text" name="price_range" class="form-control" required />
        </div>

        <div class="form-group">
          <label class="form-label">Years of Experience</label>
          <input type="number" name="experience" class="form-control" required />
        </div>

        <div class="form-group">
          <label class="form-label">Short Description</label>
          <textarea name="description" rows="4" class="form-control" required></textarea>
        </div>

        <div class="button-group">
          <button type="button" class="nav-button" onclick="prevStep()">Previous</button>
          <button type="submit" class="submit-button">Add Provider</button>
        </div>
      </div>
    </div>

    <a class="back-link" href="manage_providers.php?category=<?php echo urlencode($category); ?>">← Back to Providers List</a>
  </form>
</div>

<script>
  let currentStep = 1;
  function nextStep() {
    document.querySelector('.step-' + currentStep).classList.remove('active');
    document.querySelector('.step-section.step-' + currentStep).classList.remove('active');
    currentStep++;
    document.querySelector('.step-' + currentStep).classList.add('active');
    document.querySelector('.step-section.step-' + currentStep).classList.add('active');
  }

  function prevStep() {
    document.querySelector('.step-' + currentStep).classList.remove('active');
    document.querySelector('.step-section.step-' + currentStep).classList.remove('active');
    currentStep--;
    document.querySelector('.step-' + currentStep).classList.add('active');
    document.querySelector('.step-section.step-' + currentStep).classList.add('active');
  }
</script>

</body>
</html>
