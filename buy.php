<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $is_customer = $_POST['is_customer'];

    if ($is_customer == "yes") {
        $user_id = $_SESSION['user_id'];
        $conn = new mysqli("onnjomlc4vqc55fw.chr7pe7iynqr.eu-west-1.rds.amazonaws.com", "cux5nmdarh8rqgpx", "zjd0gozcfoirbp2a", "laonzmp2o0pw3k5c", 3306);
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
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Are you a customer?</label><br>
        <input type="radio" name="is_customer" value="yes"> Yes<br>
        <input type="radio" name="is_customer" value="no" checked> No<br>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>
