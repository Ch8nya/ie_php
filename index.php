<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    // Connect to the database
    $conn = new mysqli("onnjomlc4vqc55fw.chr7pe7iynqr.eu-west-1.rds.amazonaws.com", "cux5nmdarh8rqgpx", "zjd0gozcfoirbp2a", "laonzmp2o0pw3k5c", 3306);
    
    // Check the user's buy_status
    $sql = "SELECT buy_status FROM users WHERE id = $user_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $buy_status = $row['buy_status'];
    
    if ($buy_status == 1) {
        // User has bought the product, redirect to learn.php
        header("Location: learn.php");
        exit();
    } else {
        // User hasn't bought the product, redirect to buy.php
        header("Location: buy.php");
        exit();
    }
} else {
    // User is not logged in, redirect to login.php
    header("Location: login.php");
    exit();
}
?>
