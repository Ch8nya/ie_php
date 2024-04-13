<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT buy_status FROM users WHERE id = $user_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$buy_status = $row['buy_status'];

if ($buy_status != 1) {
    header("Location: buy.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Learn</title>
</head>
<body>
    <h2>Learning Content</h2>
    <p>Here is the learning content for the purchased product.</p>
</body>
</html>
