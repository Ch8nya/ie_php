<?php
require_once 'config.php';  // Your database connection

$input = file_get_contents('php://input');
$event = json_decode($input);

if (isset($event->event) && $event->event == 'payment.captured') {
    $payment_id = $event->payload->payment->entity->id;
    // Fetch the user_id associated with the payment (store the user_id with payment info if needed)
    $user_id = $_SESSION['user_id']; // Ensure you have a way to map payment to user

    // Update the buy status in the database
    $sql = "UPDATE users SET buy_status = 1 WHERE id = $user_id";
    if ($conn->query($sql) === TRUE) {
        http_response_code(200);
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    http_response_code(400);
}
?>
