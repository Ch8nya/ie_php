<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
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
