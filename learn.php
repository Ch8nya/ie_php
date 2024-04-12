<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$conn = new mysqli("onnjomlc4vqc55fw.chr7pe7iynqr.eu-west-1.rds.amazonaws.com", "cux5nmdarh8rqgpx", "zjd0gozcfoirbp2a", "laonzmp2o0pw3k5c", 3306);
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
    <h2>Learn</h2>
    <p>Here you will learn.</p>
</body>
</html>
