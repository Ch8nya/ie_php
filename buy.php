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
    }
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$interestRecorded = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['is_interested'])) {
        $sql = "UPDATE users SET is_interested = 1 WHERE id = $user_id";
        if ($conn->query($sql) === TRUE) {
            $interestRecorded = true;
        } else {
            echo "Error updating interest: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<!-- This site was created in Webflow. https://www.webflow.com --><!-- Last Published: Tue Apr 16 2024 10:48:33 GMT+0000 (Coordinated Universal Time) -->
<html data-wf-domain="ie-site-final.webflow.io" data-wf-page="660eaa71aa6222fb22563105"
    data-wf-site="660eaa71aa6222fb22563027" lang="en">
<head>
    <meta charset="utf-8" />
    <title>Projects</title>
    <meta content="Projects" property="og:title" />
    <meta content="Projects" property="twitter:title" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link
        href="styles.css"
        rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
    <script
        type="text/javascript">WebFont.load({ google: { families: ["Montserrat:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"] } });</script>
    <script
        type="text/javascript">!function (o, c) { var n = c.documentElement, t = " w-mod-"; n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch") }(window, document);</script>
    <link href="assets/Favicon.png" rel="shortcut icon" type="image/x-icon" />
    <link href="assets/Favicon.png" rel="apple-touch-icon" />
    <link href="assets/Favicon.png" rel="icon" type="image/x-icon" />
    <style>
        .centered-div-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50vh;
            text-align: center;
        }
        .centered-div {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <div data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease"
        role="banner" class="navbar w-nav">
        <div class="loggnavigation-wrap"><a href="#" class="logo-link w-nav-brand"><img
                    src="assets/Logo2.png"
                    width="Auto" alt="" class="logo-image-2" /></a>
            <div class="div-block-32">
                <img
                    src="https://assets-global.website-files.com/660eaa71aa6222fb22563027/66183f175b94606c96dcdc4a_icons8-user-30%20(1).png"
                    loading="lazy" alt="" class="image-12" />
                <div class="uname"><?php   $sql = "SELECT first_name FROM users WHERE id = $user_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $first_name = $row['first_name'];  echo htmlspecialchars($first_name); ?></div>
            </div>
            <div class="div-block2"><a href="logout.php" class="button login logout-btn w-inline-block"><img
                        src="https://assets-global.website-files.com/660eaa71aa6222fb22563027/66183bca5e4b790f772ecaf8_icons8-exit-30.png"
                        loading="lazy" alt="" class="image-13" /></a></div>
        </div>
    </div>
        
            <div class="centered-div-container">
        <div class="centered-div">
            <p>Hey, 
                <?php
                    $sql = "SELECT first_name FROM users WHERE id = $user_id";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $first_name = $row['first_name'];  
                    echo htmlspecialchars($first_name);
                ?>, unfortunately you are not among the first free 20 applicants. However, you are among the 50 applicants that can pay the course fees and apply. If you still wish to apply, please show your interest here and our team will contact you soon.
            </p>
            <form method="POST" action="">
                <label>
                    <input type="checkbox" name="is_interested" value="1"> I am interested.
                </label>
                <br>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <?php if ($interestRecorded): ?>
    <script type="text/javascript">
        alert("Your interest has been recorded.");
        window.location.href = "logout.php";
    </script>
    <?php endif; ?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</body>
</html>
