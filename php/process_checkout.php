<?php
header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "", "weddingplanner");

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Database connection failed"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

$firstName     = trim($data['billing']['firstName'] ?? '');
$lastName      = trim($data['billing']['lastName'] ?? '');
$email         = trim($data['billing']['email'] ?? '');
$phone         = trim($data['billing']['phone'] ?? '');
$address       = trim($data['billing']['address'] ?? '');
$city          = trim($data['billing']['city'] ?? '');
$state         = trim($data['billing']['state'] ?? '');
$zip           = trim($data['billing']['zip'] ?? '');
$country       = trim($data['billing']['country'] ?? '');
$paymentMethod = trim($data['payment']['method'] ?? '');
$cardNumber    = trim($data['payment']['cardNumber'] ?? '');
$cardExpiry    = trim($data['payment']['cardExpiry'] ?? '');
$cardCvc       = trim($data['payment']['cardCvc'] ?? '');
$cardName      = trim($data['payment']['cardName'] ?? '');
$totalPrice    = floatval($data['package']['total'] ?? 0);

if (empty($firstName) || empty($email) || empty($paymentMethod)) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Missing required fields"]);
    exit;
}

$sql = "INSERT INTO checkout_orders (
    first_name, last_name, email, phone, address, city, state, zip, country,
    payment_method, card_number, card_expiry, card_cvc, card_name, total_price
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "SQL Prepare failed: " . $conn->error]);
    exit;
}

$stmt->bind_param(
    "ssssssssssssssd",
    $firstName, $lastName, $email, $phone, $address, $city, $state, $zip,
    $country, $paymentMethod, $cardNumber, $cardExpiry, $cardCvc, $cardName, $totalPrice
);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "orderId" => $stmt->insert_id]);
} else {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
