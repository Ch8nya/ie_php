<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT score FROM users WHERE id = $user_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($row) {
    echo json_encode(['score' => $row['score']]);
} else {
    echo json_encode(['error' => 'User not found']);
}

exit();
?>
