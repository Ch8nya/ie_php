<?php
session_start();
require_once 'config.php';

if (isset($_SESSION['user_id'])) {
   header("Location: learn.php");
   exit();
}

$signupSuccessMsg = '';
if (isset($_SESSION['signup_success'])) {
   $signupSuccessMsg = $_SESSION['signup_success'];
   unset($_SESSION['signup_success']);
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $email = $_POST['email'];
   $password = $_POST['password'];

   // Prepare and execute the SQL statement
   $stmt = $conn->prepare("SELECT id, moduleNumber, lessonNumber FROM users WHERE email = ? AND password = ?");
   $stmt->bind_param("ss", $email, $password);
   $stmt->execute();
   $stmt->store_result();

   if ($stmt->num_rows == 1) {
       $stmt->bind_result($id, $moduleNumber, $lessonNumber);
       $stmt->fetch();
       $_SESSION['user_id'] = $id;

       // Save the moduleNumber and lessonNumber in session
       $_SESSION['moduleNumber'] = $moduleNumber;
       $_SESSION['lessonNumber'] = $lessonNumber;

       header("Location: index.php");
       exit();
   } else {
       $error = "Invalid email or password";
   }

   $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8" />
   <title>Login</title>
   <meta content="width=device-width, initial-scale=1" name="viewport" />
   <link href="styles.css" rel="stylesheet" type="text/css" />
   <link rel="icon" href="favicon.ico" type="image/x-icon">
   <link href="https://fonts.googleapis.com" rel="preconnect" />
   <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin="anonymous" />
   <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
   <script type="text/javascript">WebFont.load({ google: { families: ["Montserrat:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"] } });</script>
</head>
<body>
   <div data-collapse="medium" data-animation="default" data-duration="400" data-easing="ease" data-easing2="ease"
       role="banner" class="navigation w-nav">
       <div class="navigation-wrap"><a href="Program.html" class="logo-link w-nav-brand"><img
                   src="https://assets-global.website-files.com/660eaa71aa6222fb22563027/660ffb0d9afac914e8c09994_Frame%201.png"
                   width="Auto" alt="" class="logo-image" /></a>
           <div class="menu">
               <nav role="navigation" class="navigation-items w-nav-menu"><a href="viewlistings.html"
                       class="navigation-item w-nav-link">VIEW LISTINGS</a><a href="https://forms.gle/jR9mq5C2osiWQsMv7"
                       class="navigation-item w-nav-link">HIRE INTERNS</a><a href="Contact.html"
                       class="navigation-item w-nav-link">CONTACT US</a><a href="About.html"
                       class="navigation-item highlight w-nav-link">ABOUT</a>
                   <div class="menu-div-block"><a href="signup.php" class="button signup-btn w-inline-block">
                           <div class="signup-text"><strong>SIGNUP</strong></div>
                       </a><a href="login.php" aria-current="page" class="button login w-inline-block w--current">
                           <div class="login-text"><strong>LOGIN</strong></div>
                       </a></div>
               </nav>
               <div class="menu-button w-nav-button"><img
                       src="https://assets-global.website-files.com/660eaa71aa6222fb22563027/660eaa71aa6222fb22563122_menu-icon.png"
                       width="22" alt="" class="menu-icon" /></div>
           </div>
           <div class="div-block"><a href="signup.php" class="button signup-btn w-inline-block">
                   <div class="signup-text"><strong>SIGNUP</strong></div>
               </a><a href="login.php" aria-current="page" class="button login w-inline-block w--current">
                   <div class="login-text"><strong>LOGIN</strong></div>
               </a></div>
       </div>
   </div>
   <div class="div-block-20">
       <div class="form-block w-form">
           <h1 class="heading">Login</h1>
           <div class="text-block-7">Log into your account.</div>
           <?php 
           if (!empty($signupSuccessMsg)) { 
               echo "<div class='signup-success w-form-done'><div>$signupSuccessMsg</div></div>"; 
           }
           if (!empty($error)) { 
               echo "<script type='text/javascript'>var invalidCredentials = true;</script>";
           } 
           ?>
           <form id="email-form" name="email-form" data-name="Email Form" method="POST" class="loginform">
               <input class="form-field w-input" maxlength="256" name="email" placeholder="Email Address" type="email" required="" />
               <input class="form-field w-input" maxlength="256" name="password" placeholder="Password" type="password" required="" />
               <input type="submit" data-wait="Please wait..." class="form-field create-acc-btn w-button" value="Login" />
           </form>
           <div class="text-block-7 login-text">Don't have an account? <a href="signup.php" class="signup-link"> Signup</a></div>
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
    <script type="text/javascript">
        if (typeof invalidCredentials !== 'undefined' && invalidCredentials) {
            alert('Invalid Credentials!');
        }
    </script>
</body>
</html>
