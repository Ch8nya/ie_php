<?php
session_start();
require_once 'config.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT buy_status FROM users WHERE id = $user_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $buy_status = $row['buy_status'];

    if ($buy_status == 1) {
        header("Location: learn.php");
        exit();
    } else {
        header("Location: buy.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>
