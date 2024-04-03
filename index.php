<?php
// Start the session
session_start();

// Define variables for database connection
$host = 'onnjomlc4vqc55fw.chr7pe7iynqr.eu-west-1.rds.amazonaws.com';
$dbUsername = 'cux5nmdarh8rqgpx';
$dbPassword = 'zjd0gozcfoirbp2a';
$dbName = 'laonzmp2o0pw3k5c';
$port = '3306';

// Attempt to connect to the database
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password']; // This should be hashed in a real application

    // SQL to check if the user exists
    $sql = "SELECT * FROM users WHERE email = ?";
    
    // Prepare statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify password (assuming the password in the database is hashed)
        if (password_verify($password, $user['password'])) {
            // Password is correct, redirect to homepage
            $_SESSION['user_id'] = $user['id']; // Store user id in session
            header("Location: homepage.php");
            exit();
        } else {
            echo "<script>alert('Invalid password.');</script>";
        }
    } else {
        echo "<script>alert('No user found with that email address.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        /* Inline CSS for demonstration */
        .login-container {
            width: 100%;
            margin: 0 auto;
            padding-top: 1rem;
            text-align: center;
            background-color: #fff;
        }
        
        p {
            color: #818181;
            margin-top: 2rem;
            margin-bottom: 1.5rem;
        }
        
        .login-form {
            width: 20%;
            text-align: left;
            margin: 0 auto;
        }
        
        h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #333;
        }
        
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border: 2px solid #D1D1D1;
            border-radius: 10px;
            background-color: #FFFFFF;
            color: #818181;
        }
        
        .password-container {
            position: relative;
        }
        
        .terms-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            color: #333;
        }

        .terms-container a {
            margin-left: 1rem;
        }
        
        input[type="checkbox"] {
            width: fit-content;
            height: fit-content;
        }
        
        .terms-container label {
            margin-left: 0.5rem;
        }
        
        .create-account-btn {
            width: 100%;
            padding: 0.5rem;
            background-color: #7754F6;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        a {
            text-align: center;
            color:#7754F6;
        }
        
        form {
            padding-bottom: 3rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form class="login-form" method="POST">
            <h1>Login</h1>
            <p>Login into your account</p>
            <input type="email" name="email" placeholder="Email Address" required />
            <div class="password-container">
                <input type="password" name="password" placeholder="Password" required />
            </div>
            <div class="terms-container">
                <input type="checkbox" id="terms-checkbox" name="keep_logged_in" />
                <label for="terms-checkbox">Keep me logged in</label>
                <a href="#">Forgot Password?</a>
            </div>
            <button type="submit" class="create-account-btn">Login</button>
        </form>
    </div>
</body>
</html>
