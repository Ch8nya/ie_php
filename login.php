<?php
session_start();

if (isset($_SESSION['user_id'])) {
    // User is already logged in, check buy_status
    $conn = new mysqli("onnjomlc4vqc55fw.chr7pe7iynqr.eu-west-1.rds.amazonaws.com", "cux5nmdarh8rqgpx", "zjd0gozcfoirbp2a", "laonzmp2o0pw3k5c", 3306);
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
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = new mysqli("onnjomlc4vqc55fw.chr7pe7iynqr.eu-west-1.rds.amazonaws.com", "cux5nmdarh8rqgpx", "zjd0gozcfoirbp2a", "laonzmp2o0pw3k5c", 3306);
    $sql = "SELECT id, buy_status FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        
        if ($row['buy_status'] == 1) {
            header("Location: learn.php");
        } else {
            header("Location: buy.php");
        }
        exit();
    } else {
        echo "Invalid email or password";
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
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Email:</label>
        <input type="email" name="email" required><br>
        
        <label>Password:</label>
        <input type="password" name="password" required><br>
        
        <input type="submit" value="Login">
    </form>
    
    <p>New user? <a href="signup.php">Sign up here</a></p>
</body>
</html>
