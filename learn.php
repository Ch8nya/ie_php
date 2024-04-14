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
    <h2>Learn</h2>
    <?php
    $sql = "SELECT first_name FROM users WHERE id = $user_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $first_name = $row['first_name'];
    echo "<p>Welcome, $first_name!</p>";
    ?>
    <p>You have access to the learning materials.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
