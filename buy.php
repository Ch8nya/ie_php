<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $is_customer = $_POST['is_customer'];

    if ($is_customer == 'yes') {
        $sql = "UPDATE users SET buy_status = 1 WHERE id = $user_id";
        $conn->query($sql);
        header("Location: learn.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Buy</title>
</head>
<body>
    <h2>Buy</h2>
    <form method="POST" action="">
        <p>Are you a customer?</p>
        <input type="radio" name="is_customer" value="yes" required> Yes<br>
        <input type="radio" name="is_customer" value="no" required> No<br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
