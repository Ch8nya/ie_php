<?php
session_start();
require_once 'config.php';

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT buy_status FROM users WHERE id = $user_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $buy_status = $row['buy_status'];

    // Redirect based on buy_status
    if ($buy_status == 1) {
        header("Location: learn.php");
        exit();
    } else {
        header("Location: https://rzp.io/l/GVJWXB2");
        exit();
    }
} else {
    // If user is not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

// Handle POST request to update buy_status
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "UPDATE users SET buy_status = 1 WHERE id = $user_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: learn.php");
        exit();
    } else {
        echo "Error updating buy status: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Buy Product</title>
</head>
<body>
    <h2>Buy Product</h2>
    <form method="POST" action="">
        <input type="submit" value="Buy Now">
    </form>
</body>
</html>
