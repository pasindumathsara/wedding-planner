<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Manage Providers - Select Category</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 40px; background:#f5f5f5; }
    .container { max-width: 400px; margin: auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px #aaa; }
    h2 { text-align: center; margin-bottom: 20px; }
    select, button {
      width: 100%; padding: 10px; font-size: 16px; margin-top: 10px; border-radius: 6px; border: 1px solid #ccc;
    }
    button {
      background: #b76e79; color: white; border:none; cursor: pointer;
    }
    button:hover { background: rgba(98, 13, 31, 1); }
  </style>
</head>
<body>
  <div class="container">
    <h2>Select Provider Category</h2>
    <form method="GET" action="manage_providers.php">
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
</body>
</html>
