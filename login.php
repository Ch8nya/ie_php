<?php

session_start();
require_once 'config.php';

if (isset($_SESSION['user_id'])) {
    header("Location: learn.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['signup_success'] = true; // Add this line
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid email or password";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php
    if (isset($error)) {
        echo "<p>$error</p>";
    } elseif (isset($_SESSION['signup_success'])) {
        echo "<p>Signup successful. Please login.</p>";
        unset($_SESSION['signup_success']);
    }
    ?>
    <form method="POST" action="">
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
    <p>New user? <a href="signup.php">Sign up here</a></p>
</body>
</html>
