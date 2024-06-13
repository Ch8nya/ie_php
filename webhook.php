<?php
require('razorpay-php/Razorpay.php');
require_once 'config.php';  // Your database connection
use Razorpay\Api\Api;

$keyId = 'YOUR_RAZORPAY_KEY_ID';
$keySecret = 'eibuypage4321';
$api = new Api($keyId, $keySecret);

$webhookSecret = 'YOUR_WEBHOOK_SECRET';

// Capture the webhook request body
$input = file_get_contents('php://input');
$event = json_decode($input, true);

// Capture the Razorpay webhook signature
$webhookSignature = $_SERVER['HTTP_X_RAZORPAY_SIGNATURE'];

try {
    // Verify the webhook signature
    $api->utility->verifyWebhookSignature($input, $webhookSignature, $webhookSecret);

    if ($event['event'] == 'payment.captured') {
        $paymentId = $event['payload']['payment']['entity']['id'];

        // Start session management
        session_start();

        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];

            // Update the buy status in the database
            $sql = "UPDATE users SET buy_status = 1 WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $userId);

            if ($stmt->execute() === TRUE) {
                http_response_code(200); // Respond with a 200 status code to acknowledge receipt of the webhook
            } else {
                echo "Error updating record: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "User ID not found in session.";
            http_response_code(400);
        }
    } else {
        http_response_code(400);
        echo "Event not handled.";
    }
} catch (Exception $e) {
    http_response_code(400); // Respond with a 400 status code if there is an error
    echo 'Razorpay Error: ' . $e->getMessage();
}
?>
