<?php
include 'db.php';

$query = "
    SELECT 
        wp.*,
        p1.name AS photographer,
        p2.name AS caterer,
        p3.name AS venue,
        p4.name AS makeup
    FROM wedding_packages wp
    LEFT JOIN providers p1 ON wp.photographer_id = p1.id
    LEFT JOIN providers p2 ON wp.caterer_id = p2.id
    LEFT JOIN providers p3 ON wp.venue_id = p3.id
    LEFT JOIN providers p4 ON wp.makeup_id = p4.id
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Wedding Packages</title>
  <link rel="stylesheet" href="../css/style.css">
  <style>
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: 'Segoe UI', sans-serif;
      overflow-x: hidden;
    }

    video.bg-video {
      position: fixed;
      right: 0;
      bottom: 0;
      min-width: 100%;
      min-height: 100%;
      z-index: -1;
      object-fit: cover;
      opacity: 0.5;
    }

    body {
      padding: 30px;
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
      color: white;
    }

    .package-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 25px;
    }

    .card {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
      overflow: hidden;
      transition: transform 0.3s;
    }

    .card:hover {
      transform: scale(1.02);
    }

    .card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .card-body {
      padding: 20px;
    }

    .card-title {
      font-size: 20px;
      margin-bottom: 10px;
      color: #e5738c;
    }

    .card-text {
      font-size: 14px;
      color: #555;
      margin-bottom: 10px;
    }

    .price-tag {
      font-size: 18px;
      font-weight: bold;
      color: #ee9ca7;
      margin-top: 10px;
    }

    .provider-list {
      font-size: 13px;
      color: #666;
      line-height: 1.5;
      margin-top: 10px;
    }

    .no-packages {
      text-align: center;
      font-size: 20px;
      color: #777;
      margin-top: 40px;
    }
  </style>
</head>
<body>

  <!-- Background Video -->
  <video autoplay muted loop class="bg-video">
    <source src="../images/wedding-bg.mp4" type="video/mp4">
    Your browser does not support HTML5 video.
  </video>

  <h1><i class="fas fa-eye"></i> View Wedding Packages</h1>
  <br><br>

  <?php if (mysqli_num_rows($result) > 0): ?>
    <div class="package-grid">
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="card">
          <img src="../uploads/<?php echo htmlspecialchars($row['main_image']); ?>" alt="Package Image">
          <div class="card-body">
            <div class="card-title"><?php echo htmlspecialchars($row['title']); ?></div>
            <div class="card-text"><?php echo htmlspecialchars($row['description']); ?></div>
            <div class="provider-list">
              📷 Photographer: <strong><?php echo $row['photographer'] ?? 'N/A'; ?></strong><br>
              🍽️ Caterer: <strong><?php echo $row['caterer'] ?? 'N/A'; ?></strong><br>
              🏰 Venue: <strong><?php echo $row['venue'] ?? 'N/A'; ?></strong><br>
              💄 Makeup: <strong><?php echo $row['makeup'] ?? 'N/A'; ?></strong>
            </div>
            <div class="price-tag">LKR <?php echo number_format($row['price'], 2); ?></div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  <?php else: ?>
    <div class="no-packages">No wedding packages found.</div>
  <?php endif; ?>

</body>
</html>
