<?php
session_start();
require_once 'config.php';

if (isset($_SESSION['user_id'])) {
    header("Location: learn.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (first_name, last_name, email, password, buy_status) VALUES ('$first_name', '$last_name', '$email', '$password', 0)";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['signup_success'] = "Signup successful, now login here.";
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html data-wf-domain="ie-site-final.webflow.io" data-wf-page="660eaa71aa6222fb22563107" data-wf-site="660eaa71aa6222fb22563027" lang="en">
<head>
    <meta charset="utf-8" />
    <title>SignUp</title>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link href="styles.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
    <script type="text/javascript">WebFont.load({ google: { families: ["Montserrat:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"] } });</script>
    <link href="assets/Favicon.png" rel="shortcut icon" type="image/x-icon" />
    <link href="assets/Favicon.png" rel="apple-touch-icon" />
</head>
<body>
        <div data-collapse="medium" data-animation="default" data-duration="400" data-easing="ease" data-easing2="ease"
        role="banner" class="navigation w-nav">
        <div class="navigation-wrap"><a href="Program.html" class="logo-link w-nav-brand"><img
                    src="https://assets-global.website-files.com/660eaa71aa6222fb22563027/660ffb0d9afac914e8c09994_Frame%201.png"
                    width="Auto" alt="" class="logo-image" /></a>
            <div class="menu">
                <nav role="navigation" class="navigation-items w-nav-menu"><a href="#"
                        class="navigation-item w-nav-link">VIEW LISTINGS</a><a href="#"
                        class="navigation-item w-nav-link">HIRE INTERNS</a><a href="Contact.html"
                        class="navigation-item w-nav-link">CONTACT US</a><a href="About.html"
                        class="navigation-item highlight w-nav-link">ABOUT</a>
                    <div class="menu-div-block"><a href="SignUp.html" aria-current="page"
                            class="button signup-btn w-inline-block w--current">
                            <div class="signup-text"><strong>SIGNUP</strong></div>
                        </a><a href="login.php" class="button login w-inline-block">
                            <div class="login-text"><strong>LOGIN</strong></div>
                        </a></div>
                </nav>
                <div class="menu-button w-nav-button"><img
                        src="https://assets-global.website-files.com/660eaa71aa6222fb22563027/660eaa71aa6222fb22563122_menu-icon.png"
                        width="22" alt="" class="menu-icon" /></div>
            </div>
            <div class="div-block"><a href="SignUp.html" aria-current="page"
                    class="button signup-btn w-inline-block w--current">
                    <div class="signup-text"><strong>SIGNUP</strong></div>
                </a><a href="login.php" class="button login w-inline-block">
                    <div class="login-text"><strong>LOGIN</strong></div>
                </a></div>
        </div>
    </div>

    <div class="div-block-20">
        <div class="form-block w-form">
            <h1 class="heading">Sign Up</h1>
            <div class="text-block-7">Create your account in seconds</div>
            <form id="email-form" name="email-form" data-name="Email Form" method="POST" class="signupform">
                <input class="form-field w-input" autofocus="true" maxlength="256" name="first_name" data-name="First_Name" placeholder="First Name:" type="text" id="First_Name" required="" />
                <input class="form-field w-input" maxlength="256" name="last_name" data-name="Last_Name" placeholder="Last Name:" type="text" id="Last_Name" required="" />
                <input class="form-field w-input" maxlength="256" name="email" data-name="Email" placeholder="Email Address:" type="email" id="email" required="" />
                <input class="form-field w-input" maxlength="256" name="password" data-name="Password" placeholder="Create Password:" type="password" id="Password" required="" />
                <label class="w-checkbox terms-checkbox">
                    <input type="checkbox" name="checkbox" id="checkbox" data-name="Checkbox" class="w-checkbox-input checkbox" />
                    <span class="checkbox-label w-form-label" for="checkbox">I agree to the terms and privacy policy</span>
                </label>
                <input type="submit" data-wait="Please wait..." class="form-field create-acc-btn w-button" value="Create Account" />
            </form>
            <div class="text-block-7 login-text">Already a member? <a href="login.php" class="login-link">Login</a></div>
        </div>
    </div>

       <div class="footer">
        <div class="div-block-16"><a href="/" aria-current="page" class="link w--current">InternEase</a><a href="About.html"
                class="link-text">About Us</a><a href="Contact.html" class="link-text">Contact Us</a><a href="API Disclosure.html"
                class="link-text">API Disclosure</a><a href="Customer Care.html" class="link-text">Customer Care</a>
            <div class="div-block-17"><img
                    src="https://assets-global.website-files.com/660eaa71aa6222fb22563027/66102a2bc0f3eb360c4ab46c_linkedin.png"
                    loading="lazy" alt="" class="image-7" /><a href="https://www.linkedin.com/company/interneaseltd/" class="link-text company-link"><strong>Connect
                        with Us</strong></a></div>
        </div>
        <div class="div-block-19">
            <div class="text-block-6">Copyright © 2024 InternEase Pvt. Ltd. All rights reserved.</div>
            <div class="div-block-18"><a href="Privacy Policy.html" class="footer-links">Privacy Policy</a>
                <div class="link-line"></div><a href="TandC.html" class="footer-links">Terms and Conditions</a>
                <div class="link-line"></div><a href="Refunds.html" class="footer-links">Refunds</a>
                <div class="link-line"></div><a href="Legal.html" class="footer-links">Legal</a>
            </div>
        </div>
    </div>

    <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=660eaa71aa6222fb22563027" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="script.js" type="text/javascript"></script>
</body>
</html>
